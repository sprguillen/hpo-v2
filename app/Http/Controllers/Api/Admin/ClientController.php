<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreReqest;

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
        $client->password = $request->password;
        $client->first_name = $request->firstName;
        $client->last_name = $request->lastName;
        $client->username = $this->createUserName($request->email); // get username based on email
        $client->type = 'client';
        $client->role = User::ROLE_CLIENT;
        $client->save();

        return successful(trans('admin.client.store.success'), [
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
    public function update(Request $request, $id)
    {

    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
