<?php

namespace Tests\Api\Admin\System;

use Tests\TestCase;
use App\Models\PatientType;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPatientTypeTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetPatientTypeList()
    {
        $this->asAdmin();

        $response = $this->json('GET', route('api.admin.system.patient_type'));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);
    }

    /**
     * @test
     */
    public function canAdminStoreNewPatientType()
    {
        $this->asAdmin();

        $name = $this->getRandomUniqueData('patient_types', 'name', 'domainWord');
        $code = $this->getRandomUniqueData('patient_types', 'code', 'tld');

        $response = $this->json('POST', route('api.admin.system.patient_type.store'), [
            'name' => $name,
            'code' => $code,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.patient_type.success.store'),
                'patient_type' => [
                    'name' => $name,
                    'code' => $code,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminUpdatePatientType()
    {
        $this->asAdmin();

        // Find random client
        $patient_type = $this->findRandomData('patient_types');
        $name = $patient_type->name;

        $newName = $this->getRandomUniqueData('patient_types', 'name', 'domainWord');

        $response = $this->json('POST', route('api.admin.system.patient_type.update', ['name' => $name]), [
            'id' => $patient_type->id,
            'name' => $newName,
            'code' => $patient_type->code,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.patient_type.success.update', ['name' => $name]),
                'patient_type' => [
                    'id' => $patient_type->id,
                    'code' => $patient_type->code,
                    'name' => $newName,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminDeletePatientType()
    {
        $this->asAdmin();

        // Client
        $patient_type = PatientType::first();
        $deletedId = $patient_type->id;
        $response = $this->json('POST', route('api.admin.system.patient_type.destroy', ['id' => $patient_type->id]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.patient_type.success.destroy'),
            ]);
        $this->assertNull(PatientType::find($deletedId));
    }
}
