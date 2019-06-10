<?php

namespace App\Http\Controllers\Api\Client;

use Hash;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Patient\StoreRequest;
use App\Http\Requests\Client\Patient\UpdateRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::where('client_id', auth()->user()->id)->paginate(10);
        return success_data(compact('patients'));
    }

    /**
     * Store
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $timestamp = \Carbon\Carbon::now()->timestamp;
        
        $patient = new Patient();
        $patient->client_id = auth()->user()->id;
        $patient->code = $timestamp;
        $patient->global_custom_id = $timestamp;
        $patient->hpo_patient_id = $timestamp;
        $patient->client_custom_id = $request->client_custom_id;
        $patient->email = $request->email;
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->mothers_maiden_name = $request->mothers_maiden_name;
        $patient->gender = $request->gender;
        $patient->birth_date = $request->birth_date;
        $patient->passport_number = $request->passport_number;
        $patient->citizen = $request->citizen;
        $patient->blood_type = $request->blood_type;
        $patient->address = $request->address;
        $patient->city = $request->city;
        $patient->senior_citizen_id = $request->senior_citizen_id;
        $patient->telephone_number = $request->telephone_number;
        $patient->fax_number = $request->fax_number;
        $patient->mobile_number = $request->mobile_number;
        $patient->occupation = $request->occupation;
        $patient->hmo_card = $request->hmo_card;
        $patient->hmo_card_no = $request->hmo_card_no;
        $patient->last_visit_at = $request->last_visit_at;
        $patient->save();

        return successful(trans('message.client.patient.success.store'), [
            'patient' => $patient,
        ]);
    }

    /**
     * Update
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $patient = Patient::findOrFail($request->id);
        $patient->email = $request->email;
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->mothers_maiden_name = $request->mothers_maiden_name;
        $patient->gender = $request->gender;
        $patient->birth_date = $request->birth_date;
        $patient->passport_number = $request->passport_number;
        $patient->citizen = $request->citizen;
        $patient->blood_type = $request->blood_type;
        $patient->address = $request->address;
        $patient->city = $request->city;
        $patient->senior_citizen_id = $request->senior_citizen_id;
        $patient->telephone_number = $request->telephone_number;
        $patient->fax_number = $request->fax_number;
        $patient->mobile_number = $request->mobile_number;
        $patient->occupation = $request->occupation;
        $patient->hmo_card = $request->hmo_card;
        $patient->hmo_card_no = $request->hmo_card_no;
        $patient->save();

        return successful(trans('message.client.patient.success.update'), [
            'patient' => $patient,
        ]);
    }

    /**
     * Archive
     *
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, $id)
    {
        $patient = Patient::findOrFail($request->id);
        $patient->delete();
        return successful(trans('message.client.patient.success.archive'));
    }

    /**
     * Search client based on key
     *
     * @param  string $key
     * @return \Illuminate\Http\Response
     */
    public function search($key)
    {
        $staffs = User::staff()->findByName($key)->wherehas('staffclient', function($query) {
            $query->where('client_id', '=', auth()->user()->id);
        })->paginate(10);

        return success_data(compact('staffs'));
    }
}
