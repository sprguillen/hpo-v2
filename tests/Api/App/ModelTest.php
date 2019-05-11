<?php

namespace Tests\Api\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use App\Models\User;
use Tests\TestCase;
use Carbon\Carbon;
use Hash;

class ModelTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function makeSureReturnedDataOnUserModelDoesNotIncludeHiddenData()
    {
        $passportCredentials = passport_client_credentials();

        $user = User::orderByRaw('RAND()')->first();

        $response = $this->json('POST', route('login'), [
            'username' => $user->username,
            'password' => 'secret',
            'client_id' => $passportCredentials->id,
            'client_secret' => $passportCredentials->secret,
            'grant_type' => 'password'
        ]);

        $responseData = $response->getOriginalContent();

        // Check if response `logged_in_user` does not contain `hidden` data
        $responseUser = $responseData['logged_in_user'];
        $this->assertArrayHasKey('logged_in_user', $responseData);
        $this->assertSame($user->id, $responseUser->id);

        $this->assertObjectNotHasAttribute('password', $responseUser);
        $this->assertObjectNotHasAttribute('remember_token', $responseUser);


    }

    /**
     * @test
     */
    public function hideHiddenFieldsOnUserModelOnApiResponseUserGetMe()
    {
        $this->loggedUserClient();
        Passport::actingAs($this->user);

        // Check on `api/user/me` route
        $response = $this->json('GET', route('api.user.me'));
        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->user);
        $this->assertEquals($data->user->id, $this->user->id);
        $this->assertObjectNotHasAttribute('password', $data->user);
        $this->assertObjectNotHasAttribute('remember_token', $data->user);
    }

    /**
     * @test
     */
    public function makeSureCreatedModelIsRightTimeZone()
    {
        $user = new User();
        $user->global_prefix = '';
        $user->username = $this->faker->userName;
        $user->email = $this->faker->freeEmail;
        $user->password = Hash::make('secret');
        $user->first_name = $this->faker->firstNameMale;
        $user->last_name = $this->faker->lastName;
        $user->contact_number = $this->faker->phoneNumber;
        $user->business_name = $this->faker->company;
        $user->business_address = $this->faker->address;
        $user->is_active = true;
        $user->save();

        $newUser = User::find($user->id);
        $created_at = $newUser->created_at;

        // CHeck timezone
        $this->assertEquals($created_at->tzName, env('APP_TIMEZONE', 'Asia/Manila'));

        // Check environment or config app is on `Asia/Manila` timezone
        $this->assertEquals(config('app.timezone'), env('APP_TIMEZONE', 'Asia/Manila'));
    }
}
