<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenisUsahaRequest;
use App\Http\Requests\UpdateJenisUsahaRequest;
use App\Http\Resources\Admin\JenisUsahaResource;
use App\Models\JenisUsaha;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisUsahaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_usaha_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisUsahaResource(JenisUsaha::all());
    }

    public function store(StoreJenisUsahaRequest $request)
    {
        $jenisUsaha = JenisUsaha::create($request->all());

        return (new JenisUsahaResource($jenisUsaha))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JenisUsaha $jenisUsaha)
    {
        abort_if(Gate::denies('jenis_usaha_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisUsahaResource($jenisUsaha);
    }

    public function update(UpdateJenisUsahaRequest $request, JenisUsaha $jenisUsaha)
    {
        $jenisUsaha->update($request->all());

        return (new JenisUsahaResource($jenisUsaha))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JenisUsaha $jenisUsaha)
    {
        abort_if(Gate::denies('jenis_usaha_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsaha->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
