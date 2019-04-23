<?php

namespace App\Http\Controllers\Api\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreReqest;
use App\Http\Requests\Client\UpdateRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::client()->paginate(10);
        return success_data(compact('clients'));
    }

    /**
     * Store
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReqest $request)
    {
        $client = new User();
        $client->email = $request->email;
        $client->username = $request->username;
        $client->password = Hash::make($request->password);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->type = 'client';
        $client->role = User::ROLE_CLIENT;
        $client->save();

        return successful(trans('message.admin.client.success.store'), [
            'client' => $client,
        ]);
    }

    /**
     * Create user name based on value given
     *
     * @param  string $value
     * @return string
     */
    private function createUserName($value)
    {
        $username = explode("@", $value, 2)[0];
        // Check if username exist
        if ($count = User::where('username', $value)->count() > 0) {
            $username .= $count + 1;
        }

        return $username;
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
        $client = User::findOrFail($request->id);
        $client->email = $request->email;
        $client->username = $request->username;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->save();

        return successful(trans('message.admin.client.success.update', ['email' => $request->email]), [
            'client' => $client,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }
}
