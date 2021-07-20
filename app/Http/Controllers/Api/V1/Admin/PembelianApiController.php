<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use App\Http\Resources\Admin\PembelianResource;
use App\Models\Pembelian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PembelianApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pembelian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PembelianResource(Pembelian::with(['nama_supplier', 'nama_plastiks', 'created_by'])->get());
    }

    public function store(StorePembelianRequest $request)
    {
        $pembelian = Pembelian::create($request->all());
        $pembelian->nama_plastiks()->sync($request->input('nama_plastiks', []));
        if ($request->input('photo_manifes', false)) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo_manifes'))))->toMediaCollection('photo_manifes');
        }

        if ($request->input('photo', false)) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        return (new PembelianResource($pembelian))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pembelian $pembelian)
    {
        abort_if(Gate::denies('pembelian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PembelianResource($pembelian->load(['nama_supplier', 'nama_plastiks', 'created_by']));
    }

    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        $pembelian->update($request->all());
        $pembelian->nama_plastiks()->sync($request->input('nama_plastiks', []));
        if ($request->input('photo_manifes', false)) {
            if (!$pembelian->photo_manifes || $request->input('photo_manifes') !== $pembelian->photo_manifes->file_name) {
                if ($pembelian->photo_manifes) {
                    $pembelian->photo_manifes->delete();
                }
                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo_manifes'))))->toMediaCollection('photo_manifes');
            }
        } elseif ($pembelian->photo_manifes) {
            $pembelian->photo_manifes->delete();
        }

        if ($request->input('photo', false)) {
            if (!$pembelian->photo || $request->input('photo') !== $pembelian->photo->file_name) {
                if ($pembelian->photo) {
                    $pembelian->photo->delete();
                }
                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($pembelian->photo) {
            $pembelian->photo->delete();
        }

        if ($request->input('video', false)) {
            if (!$pembelian->video || $request->input('video') !== $pembelian->video->file_name) {
                if ($pembelian->video) {
                    $pembelian->video->delete();
                }
                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($pembelian->video) {
            $pembelian->video->delete();
        }

        return (new PembelianResource($pembelian))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pembelian $pembelian)
    {
        abort_if(Gate::denies('pembelian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembelian->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
