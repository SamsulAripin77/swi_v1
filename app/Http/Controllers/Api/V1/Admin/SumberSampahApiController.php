<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSumberSampahRequest;
use App\Http\Requests\UpdateSumberSampahRequest;
use App\Http\Resources\Admin\SumberSampahResource;
use App\Models\SumberSampah;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SumberSampahApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sumber_sampah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SumberSampahResource(SumberSampah::all());
    }

    public function store(StoreSumberSampahRequest $request)
    {
        $sumberSampah = SumberSampah::create($request->all());

        return (new SumberSampahResource($sumberSampah))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SumberSampah $sumberSampah)
    {
        abort_if(Gate::denies('sumber_sampah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SumberSampahResource($sumberSampah);
    }

    public function update(UpdateSumberSampahRequest $request, SumberSampah $sumberSampah)
    {
        $sumberSampah->update($request->all());

        return (new SumberSampahResource($sumberSampah))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SumberSampah $sumberSampah)
    {
        abort_if(Gate::denies('sumber_sampah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sumberSampah->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
