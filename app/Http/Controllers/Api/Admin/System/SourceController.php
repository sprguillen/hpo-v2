<?php

namespace App\Http\Controllers\Api\Admin\System;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\Source\StoreRequest;
use App\Http\Requests\Admin\System\Source\UpdateRequest;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::orderBy('code')->paginate(10);
        return success_data(compact('sources'));
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
        $source = new Source();
        $source->code = $request->code;
        $source->name = $request->name;
        $source->save();

        return successful(trans('message.admin.system.source.success.store'), [
            'source' => $source,
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
        $source = Source::findOrFail($request->id);
        $name = $source->name;
        $source->code = $request->code;
        $source->name = $request->name;
        $source->save();

        return successful(trans('message.admin.system.source.success.update', ['name' => $name]), [
            'source' => $source,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $source = Source::findOrFail($id);
        $source->delete();
        return successful(trans('message.admin.system.source.success.destroy'));
    }
}
