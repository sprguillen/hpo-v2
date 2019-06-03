<?php

namespace App\Http\Controllers\Api\Admin\Client;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientSource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\Source\StoreRequest;
use App\Http\Requests\Admin\Client\Source\UpdateRequest;

class SourcesController extends Controller
{

    /**
     * Get client sources
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sources = ClientSource::where('user_id', $id)->with('source')->get();

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
        $client = new ClientSource();
        $client->source_id = $request->source_id;
        $client->user_id = $request->user_id;
        $client->save();

        $name = $client->user->full_name;
        $client = ClientSource::with('source')->find($client->id);
        return successful(trans('message.admin.client.source.success.store', ['name' => $name]), [
            'client' => $client,
        ]);
    }

    /**
     * Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $sourceId)
    {
        $client = ClientSource::findOrFail($sourceId);
        $client->delete();
        return successful(trans('message.admin.client.source.success.destroy'));
    }
}
