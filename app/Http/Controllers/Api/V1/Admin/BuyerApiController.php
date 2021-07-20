<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuyerRequest;
use App\Http\Requests\UpdateBuyerRequest;
use App\Http\Resources\Admin\BuyerResource;
use App\Models\Buyer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BuyerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('buyer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BuyerResource(Buyer::with(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users'])->get());
    }

    public function store(StoreBuyerRequest $request)
    {
        $buyer = Buyer::create($request->all());
        $buyer->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $buyer->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $buyer->id_users()->sync($request->input('id_users', []));

        return (new BuyerResource($buyer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Buyer $buyer)
    {
        abort_if(Gate::denies('buyer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BuyerResource($buyer->load(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users']));
    }

    public function update(UpdateBuyerRequest $request, Buyer $buyer)
    {
        $buyer->update($request->all());
        $buyer->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $buyer->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $buyer->id_users()->sync($request->input('id_users', []));

        return (new BuyerResource($buyer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Buyer $buyer)
    {
        abort_if(Gate::denies('buyer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buyer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
