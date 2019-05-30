<?php

namespace App\Http\Controllers\Api\Admin\System;

use App\Models\PatientType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\PatientType\StoreRequest;
use App\Http\Requests\Admin\System\PatientType\UpdateRequest;

class PatientTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient_types = PatientType::orderBy('code')->get();
        return success_data(compact('patient_types'));
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
        $patient_type = new PatientType();
        $patient_type->code = $request->code;
        $patient_type->name = $request->name;
        $patient_type->save();

        return successful(trans('message.admin.system.patient_type.success.store'), [
            'patient_type' => $patient_type,
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
        $patient_type = PatientType::findOrFail($request->id);
        $name = $patient_type->name;
        $patient_type->code = $request->code;
        $patient_type->name = $request->name;
        $patient_type->save();

        return successful(trans('message.admin.system.patient_type.success.update', ['name' => $name]), [
            'patient_type' => $patient_type,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $patient_type = PatientType::findOrFail($id);
        $patient_type->delete();
        return successful(trans('message.admin.system.patient_type.success.destroy'));
    }
}
