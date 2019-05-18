<?php

namespace App\Http\Controllers\Api\Admin\Service;

use Hash;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreRequest;
use App\Http\Requests\Admin\Service\UpdateRequest;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(30);
        return success_data(compact('services'));
    }

    /**
     * Search services using code or name
     *
     * @author goper
     * @param  string $key
     * @return response
     */
    public function search($key)
    {
        $processors = Service::search($key)->paginate(10);
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
        $service = new Service();
        $service->code = $request->code;
        $service->name = $request->name;
        $service->default_cost = $request->default_cost;
        $service->save();

        return successful(trans('message.admin.service.success.store'), [
            'service' => $service,
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
        $service = Service::findOrFail($request->id);
        $name = $service->name;
        $service->code = $request->code;
        $service->name = $request->name;
        $service->default_cost = $request->default_cost;
        $service->save();

        return successful(trans('message.admin.service.success.update', ['name' => $name]), [
            'service' => $service,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return successful(trans('message.admin.service.success.destroy'));
    }

    /**
     * Display all clients accompanied by this service
     *
     * @param  [string] $code
     * @return \Illuminate\Http\Response
     */
    public function details($code)
    {
        // CHeck if code exist
        $service = Service::where('code', $code)->with('clients')->first();

        if (!$service) {
            return errorify(trans('message.admin.service.not_found'));
        }

        return success_data(compact('service'));
    }
}
