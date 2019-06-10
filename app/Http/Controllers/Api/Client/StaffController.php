<?php

namespace App\Http\Controllers\Api\Client;

use Hash;
use App\Models\User;
use App\Models\ClientStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Staff\StoreRequest;
use App\Http\Requests\Client\Staff\UpdateRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = ClientStaff::where('client_id', auth()->user()->id)->paginate(10);
        return success_data(compact('staffs'));
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
        // Save to `User` model first
        $staff = new User();
        $staff->email = $request->email;
        $staff->username = $request->username;
        $staff->password = Hash::make($request->password);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->role = User::ROLE_STAFF;
        $staff->save();

        // Save to `ClientStaff` model
        $clientStaff = new ClientStaff();
        $clientStaff->client_id = auth()->user()->id;
        $clientStaff->staff_id = $staff->id;
        $clientStaff->save();

        $staff = ClientStaff::find($clientStaff->id);
        return successful(trans('message.client.staff.success.store'), [
            'staff' => $staff,
        ]);
    }

    /**
     * Update client staff first and last name only
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $clientStaff = ClientStaff::findOrFail($request->id);
        $staff = User::findOrFail($clientStaff->staff_id);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->save();
        $clientStaff = ClientStaff::findOrFail($request->id);
        return successful(trans('message.client.staff.success.update'), [
            'staff' => $clientStaff,
        ]);
    }

    /**
     * Archive
     *
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, $id)
    {
        $clientStaff = ClientStaff::findOrFail($request->id);
        $clientStaff->delete();
        return successful(trans('message.client.staff.success.archive'));
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
