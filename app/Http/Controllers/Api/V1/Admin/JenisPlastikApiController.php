<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenisPlastikRequest;
use App\Http\Requests\UpdateJenisPlastikRequest;
use App\Http\Resources\Admin\JenisPlastikResource;
use App\Models\JenisPlastik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisPlastikApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_plastik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisPlastikResource(JenisPlastik::with(['kategori_plastik'])->get());
    }

    public function store(StoreJenisPlastikRequest $request)
    {
        $jenisPlastik = JenisPlastik::create($request->all());

        return (new JenisPlastikResource($jenisPlastik))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JenisPlastik $jenisPlastik)
    {
        abort_if(Gate::denies('jenis_plastik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisPlastikResource($jenisPlastik->load(['kategori_plastik']));
    }

    public function update(UpdateJenisPlastikRequest $request, JenisPlastik $jenisPlastik)
    {
        $jenisPlastik->update($request->all());

        return (new JenisPlastikResource($jenisPlastik))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JenisPlastik $jenisPlastik)
    {
        abort_if(Gate::denies('jenis_plastik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPlastik->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
