<?php

namespace App\Http\Controllers\Api\Admin\System;

use Illuminate\Http\Request;
use App\Models\WhiteListedIp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\WhiteListedIp\StoreRequest;
use App\Http\Requests\Admin\System\WhiteListedIp\UpdateRequest;

class WhiteListedIpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $white_listed_ips = WhiteListedIp::all();
        return success_data(compact('white_listed_ips'));
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
        $white_listed_ip = new WhiteListedIp();
        $white_listed_ip->address = $request->address;
        $white_listed_ip->save();

        return successful(trans('message.admin.system.white_listed_ip.success.store'), [
            'white_listed_ip' => $white_listed_ip,
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
        $white_listed_ip = WhiteListedIp::findOrFail($request->id);
        $white_listed_ip->address = $request->address;
        $white_listed_ip->save();

        return successful(trans('message.admin.system.white_listed_ip.success.update'), [
            'white_listed_ip' => $white_listed_ip,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $white_listed_ip = WhiteListedIp::findOrFail($id);
        $white_listed_ip->delete();
        return successful(trans('message.admin.system.white_listed_ip.success.destroy'));
    }
}
