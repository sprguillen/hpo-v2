<?php

namespace App\Http\Controllers\Api\Admin\System;

use App\Models\Dispatcher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\Dispatcher\StoreRequest;
use App\Http\Requests\Admin\System\Dispatcher\UpdateRequest;

class DispatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dispatchers = Dispatcher::orderBy('code')->paginate(10);
        return success_data(compact('dispatchers'));
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
        $dispatcher = new Dispatcher();
        $dispatcher->code = $request->code;
        $dispatcher->name = $request->name;
        $dispatcher->save();

        return successful(trans('message.admin.system.dispatcher.success.store'), [
            'dispatcher' => $dispatcher,
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
        $dispatcher = Dispatcher::findOrFail($request->id);
        $name = $dispatcher->name;
        $dispatcher->code = $request->code;
        $dispatcher->name = $request->name;
        $dispatcher->save();

        return successful(trans('message.admin.system.dispatcher.success.update', ['name' => $name]), [
            'dispatcher' => $dispatcher,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $dispatcher = Dispatcher::findOrFail($id);
        $dispatcher->delete();
        return successful(trans('message.admin.system.dispatcher.success.destroy'));
    }
}
