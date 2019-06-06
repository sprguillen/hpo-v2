<?php

namespace Tests\Api\Admin\System;

use App;
use Tests\TestCase;
use App\Models\User;
use App\Models\WhiteListedIp;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminWhiteListIpTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetWhiteListedIp()
    {
        $this->asAdmin();

        $response = $this->json('GET', route('api.admin.system.white_listed_ip'));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);
        $this->assertObjectHasAttribute('white_listed_ips', $data);
    }

    /**
     * @test
     */
    public function canAdminStoreNewWhiteListedIp()
    {
        $this->asAdmin();

        $address = $this->getRandomUniqueData('white_listed_ips', 'address', 'ipv4');

        $response = $this->json('POST', route('api.admin.system.white_listed_ip.store'), [
            'address' => $address,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.white_listed_ip.success.store'),
                'white_listed_ip' => [
                    'address' => $address,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminUpdateWhiteListedIp()
    {
        $this->asAdmin();

        $white_listed_ip = $this->findRandomData('white_listed_ips');
        $newAdress = $this->getRandomUniqueData('white_listed_ips', 'address', 'ipv4');

        $response = $this->json('POST', route('api.admin.system.white_listed_ip.update', ['id' => $white_listed_ip->id]), [
            'id' => $white_listed_ip->id,
            'address' => $newAdress,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.white_listed_ip.success.update'),
                'white_listed_ip' => [
                    'id' => $white_listed_ip->id,
                    'address' => $newAdress,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminDeleteWhiteListedIp()
    {
        $this->asAdmin();

        $white_listed_ip = WhiteListedIp::first();
        $deletedId = $white_listed_ip->id;
        $response = $this->json('POST', route('api.admin.system.white_listed_ip.destroy', ['id' => $deletedId]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.white_listed_ip.success.destroy'),
            ]);
        $this->assertNull(WhiteListedIp::find($deletedId));
    }

    /**
     * @test
     */
    public function canFilterRequestBasedOnWhiteListedIps()
    {
        putenv("APP_ENV=production");

        $user = User::orderByRaw('RAND()')->first();
        $passportCredentials = passport_client_credentials();

        $response = $this->call('POST', route('login'), [
            'username' => $user->username,
            'password' => 'secret',
            'client_id' => $passportCredentials->id,
            'client_secret' => $passportCredentials->secret,
            'grant_type' => 'password'
        ], [], [], [
            'REMOTE_ADDR' => '10.1.0.1'
        ]);

        $response
            ->assertStatus(self::RESPONSE_FORBIDDEN)
            ->assertJson([
                'success' => false,
                'message' => 'This IP address is not allowed to access the site.',
            ]);


        // Put .env variables back
        putenv("APP_ENV=testing");
    }

    /**
     * @test
     */
    public function canRequestToApiIfRequestIpIsWhiteListed()
    {
        putenv("APP_ENV=production");

        $user = User::orderByRaw('RAND()')->first();
        $validIp = WhiteListedIp::orderByRaw('RAND()')->first();

        $passportCredentials = passport_client_credentials();

        $response = $this->call('POST', route('login'), [
            'username' => $user->username,
            'password' => 'secret',
            'client_id' => $passportCredentials->id,
            'client_secret' => $passportCredentials->secret,
            'grant_type' => 'password'
        ], [], [], [
            'REMOTE_ADDR' => $validIp->address
        ]);

        $responseData = $response->getOriginalContent();
        
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.auth.login.success'),
                'access_token' => $responseData['access_token'],
                'refresh_token' => $responseData['refresh_token'],
            ]);

        // Check if response has `logged_in_user`
        $responseUser = $responseData['logged_in_user'];
        $this->assertArrayHasKey('logged_in_user', $responseData);
        $this->assertSame($user->id, $responseUser->id);

        // Put .env variables back
        putenv("APP_ENV=testing");
    }
}
