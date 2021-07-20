<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Http\Resources\Admin\PenjualanResource;
use App\Models\Penjualan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenjualanApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('penjualan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenjualanResource(Penjualan::with(['nama_buyer', 'nama_plastiks', 'created_by'])->get());
    }

    public function store(StorePenjualanRequest $request)
    {
        $penjualan = Penjualan::create($request->all());
        $penjualan->nama_plastiks()->sync($request->input('nama_plastiks', []));
        if ($request->input('photo_manifes', false)) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo_manifes'))))->toMediaCollection('photo_manifes');
        }

        if ($request->input('photo', false)) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        return (new PenjualanResource($penjualan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Penjualan $penjualan)
    {
        abort_if(Gate::denies('penjualan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenjualanResource($penjualan->load(['nama_buyer', 'nama_plastiks', 'created_by']));
    }

    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        $penjualan->update($request->all());
        $penjualan->nama_plastiks()->sync($request->input('nama_plastiks', []));
        if ($request->input('photo_manifes', false)) {
            if (!$penjualan->photo_manifes || $request->input('photo_manifes') !== $penjualan->photo_manifes->file_name) {
                if ($penjualan->photo_manifes) {
                    $penjualan->photo_manifes->delete();
                }
                $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo_manifes'))))->toMediaCollection('photo_manifes');
            }
        } elseif ($penjualan->photo_manifes) {
            $penjualan->photo_manifes->delete();
        }

        if ($request->input('photo', false)) {
            if (!$penjualan->photo || $request->input('photo') !== $penjualan->photo->file_name) {
                if ($penjualan->photo) {
                    $penjualan->photo->delete();
                }
                $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($penjualan->photo) {
            $penjualan->photo->delete();
        }

        if ($request->input('video', false)) {
            if (!$penjualan->video || $request->input('video') !== $penjualan->video->file_name) {
                if ($penjualan->video) {
                    $penjualan->video->delete();
                }
                $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($penjualan->video) {
            $penjualan->video->delete();
        }

        return (new PenjualanResource($penjualan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Penjualan $penjualan)
    {
        abort_if(Gate::denies('penjualan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penjualan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
