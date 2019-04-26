<?php

namespace App\Http\Controllers\Api\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Processor\StoreRequest;
use App\Http\Requests\Processor\UpdateRequest;

/**
 * User `processor` role controller
 * Controlled by Admin
 *
 * @author goper
 */
class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processors = User::processor()->paginate(10);
        return success_data(compact('processors'));
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
        $processor = new User();
        $processor->email = $request->email;
        $processor->username = $request->username;
        $processor->password = Hash::make($request->password);
        $processor->first_name = $request->first_name;
        $processor->last_name = $request->last_name;
        $processor->role = User::ROLE_PROCESSOR;
        $processor->save();

        return successful(trans('message.admin.processor.success.store'), [
            'processor' => $processor,
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
        $processor = User::findOrFail($request->id);
        $name = $processor->first_name . ' ' . $processor->last_name;
        $processor->email = $request->email;
        $processor->username = $request->username;
        $processor->first_name = $request->first_name;
        $processor->last_name = $request->last_name;
        $processor->save();

        return successful(trans('message.admin.processor.success.update', ['name' => $name]), [
            'processor' => $processor,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $processor = User::findOrFail($id);
        $processor->delete();
        return successful(trans('message.admin.processor.success.destroy'));
    }
}
