<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJenisPlastikRequest;
use App\Http\Requests\StoreJenisPlastikRequest;
use App\Http\Requests\UpdateJenisPlastikRequest;
use App\Models\JenisPlastik;
use App\Models\KategoriPlastik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisPlastikController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_plastik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPlastiks = JenisPlastik::with(['kategori_plastik'])->get();

        return view('admin.jenisPlastiks.index', compact('jenisPlastiks'));
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_plastik_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategori_plastiks = KategoriPlastik::all()->pluck('jenis_plastik', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jenisPlastiks.create', compact('kategori_plastiks'));
    }

    public function store(StoreJenisPlastikRequest $request)
    {
        $jenisPlastik = JenisPlastik::create($request->all());

        return redirect()->route('admin.jenis-plastiks.index');
    }

    public function edit(JenisPlastik $jenisPlastik)
    {
        abort_if(Gate::denies('jenis_plastik_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategori_plastiks = KategoriPlastik::all()->pluck('jenis_plastik', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenisPlastik->load('kategori_plastik');

        return view('admin.jenisPlastiks.edit', compact('kategori_plastiks', 'jenisPlastik'));
    }

    public function update(UpdateJenisPlastikRequest $request, JenisPlastik $jenisPlastik)
    {
        $jenisPlastik->update($request->all());

        return redirect()->route('admin.jenis-plastiks.index');
    }

    public function show(JenisPlastik $jenisPlastik)
    {
        abort_if(Gate::denies('jenis_plastik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPlastik->load('kategori_plastik');

        return view('admin.jenisPlastiks.show', compact('jenisPlastik'));
    }

    public function destroy(JenisPlastik $jenisPlastik)
    {
        abort_if(Gate::denies('jenis_plastik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisPlastik->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisPlastikRequest $request)
    {
        JenisPlastik::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
