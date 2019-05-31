<?php

namespace Tests\Api\Admin\Client;

use Tests\TestCase;
use App\Models\User;
use App\Models\Source;
use App\Models\ClientSource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminClientSourceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetClientSources()
    {
        $this->asAdmin();
        $user = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);

        $response = $this->json('GET', route('api.admin.client.sources', ['id' => $user->id]));
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertObjectHasAttribute('sources', $data);
        $responseSources = $data->sources;

        // Check on database if results match
        $client = User::withCount('sources')->find($user->id);
        $this->assertEquals(count($responseSources), $client->sources_count);
    }

    /**
     * @test
     */
    public function canGetClientSourcesDataSourceRelationship()
    {
        $this->asAdmin();
        // Find user data that is not empty
        $source = $this->findRandomData('client_sources');

        if ($source) {
            $user = User::find($source->user_id);

            $response = $this->json('GET', route('api.admin.client.sources', ['id' => $user->id]));

            $data = $response->getData();
            $response
                ->assertStatus(self::RESPONSE_SUCCESS)
                ->assertJson([
                    'success' => true,
                    'message' => '',
                ]);

            $this->assertObjectHasAttribute('sources', $data);
            $responseSources = $data->sources;

            // Check on database if results match
            $client = User::with('sources')->find($user->id);
            $this->assertEquals(count($responseSources), count($client->sources));

            // Check source response has source data on fields like code, name etc...
            $responseSource = $responseSources[0];
            $this->assertObjectHasAttribute('source', $responseSource);
            $this->assertObjectHasAttribute('code', $responseSource->source);
            $this->assertObjectHasAttribute('name', $responseSource->source);

            // Check on DB if match on response about the `source` data
            $dbSource = Source::find($responseSource->source->id);
            $this->assertEquals($dbSource->id, $responseSource->source->id);
            $this->assertEquals($dbSource->code, $responseSource->source->code);
            $this->assertEquals($dbSource->name, $responseSource->source->name);
        } else {
            $this->assertNull($source);
        }

    }

    /**
     * @test
     */
    public function canStoreSourceToAClient()
    {
        $this->asAdmin();

        // Get client user and a service
        $user = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $source = $this->findRandomData('sources');

        $name = User::find($user->id);
        $name = $name->full_name;

        $response = $this->json('POST', route('api.admin.client.sources.store', ['id' => $user->id]), [
            'user_id' => $user->id,
            'source_id' => $source->id,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.source.success.store', ['name' => $name]),
                'client' => [
                    'user_id' => $user->id,
                    'source_id' => $source->id,
                ],
            ]);
    }

    /**
     * @test
     */
    public function cannotStoreNewClientOnSourcesIfUserIsNotClient()
    {
        $this->asAdmin();

        // Get client user and a service
        $user = $this->findRandomData('users', ['role' => User::ROLE_ADMIN]); // User is not client
        $source = $this->findRandomData('sources');

        $response = $this->json('POST', route('api.admin.client.sources.store', ['id' => $user->id]), [
            'user_id' => $user->id,
            'source_id' => $source->id,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error'),
            ])
            ->assertJsonValidationErrors(['user_id']);
    }

    /**
     * @test
     */
    public function cannotStoreSourceOnClientIfSourceGivenNotExist()
    {
        $this->asAdmin();

        // Get client user and a service
        $user = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]); // User is not client
        $sourceId = 'asd231asdjk3123l23';

        $response = $this->json('POST', route('api.admin.client.sources.store', ['id' => $user->id]), [
            'user_id' => $user->id,
            'source_id' => $sourceId,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error'),
            ])
            ->assertJsonValidationErrors(['source_id']);
    }

    /**
     * @test
     */
    public function canAdminDeleteClientSource()
    {
        $this->asAdmin();

        $client = ClientSource::first();
        $user = User::find($client->user_id);
        $deletedId = $client->id;

        $response = $this->json('POST', route('api.admin.client.sources.destroy', [
            'id' => $user->id,
            'sourceId' => $deletedId
        ]));

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.source.success.destroy'),
            ]);

        $this->assertNull(ClientSource::find($deletedId));
    }
}
