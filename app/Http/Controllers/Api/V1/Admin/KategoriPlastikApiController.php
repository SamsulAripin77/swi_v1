<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriPlastikRequest;
use App\Http\Requests\UpdateKategoriPlastikRequest;
use App\Http\Resources\Admin\KategoriPlastikResource;
use App\Models\KategoriPlastik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategoriPlastikApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_plastik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriPlastikResource(KategoriPlastik::all());
    }

    public function store(StoreKategoriPlastikRequest $request)
    {
        $kategoriPlastik = KategoriPlastik::create($request->all());

        return (new KategoriPlastikResource($kategoriPlastik))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KategoriPlastik $kategoriPlastik)
    {
        abort_if(Gate::denies('kategori_plastik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriPlastikResource($kategoriPlastik);
    }

    public function update(UpdateKategoriPlastikRequest $request, KategoriPlastik $kategoriPlastik)
    {
        $kategoriPlastik->update($request->all());

        return (new KategoriPlastikResource($kategoriPlastik))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KategoriPlastik $kategoriPlastik)
    {
        abort_if(Gate::denies('kategori_plastik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriPlastik->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
