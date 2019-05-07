<?php

namespace App\Http\Controllers\Api\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRequest;
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
    public function store(StoreRequest $request)
    {
        $client = new User();
        $client->email = $request->email;
        $client->username = $request->username;
        $client->password = Hash::make($request->password);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
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
        $name = $client->first_name . ' ' . $client->last_name;
        $client->email = $request->email;
        $client->username = $request->username;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->save();

        return successful(trans('message.admin.client.success.update', ['name' => $name]), [
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
        $client = User::findOrFail($id);
        $client->delete();
        return successful(trans('message.admin.client.success.destroy'));
    }

    /**
     * Search client based on key
     *
     * @param  string $key
     * @return response
     */
    public function search($key)
    {
        $clients = User::client()->findByName($key)->paginate(10);
        return success_data(compact('clients'));
    }
}
