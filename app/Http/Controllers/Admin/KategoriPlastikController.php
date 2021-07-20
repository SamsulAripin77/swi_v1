<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKategoriPlastikRequest;
use App\Http\Requests\StoreKategoriPlastikRequest;
use App\Http\Requests\UpdateKategoriPlastikRequest;
use App\Models\KategoriPlastik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategoriPlastikController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_plastik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriPlastiks = KategoriPlastik::all();

        return view('admin.kategoriPlastiks.index', compact('kategoriPlastiks'));
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_plastik_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPlastiks.create');
    }

    public function store(StoreKategoriPlastikRequest $request)
    {
        $kategoriPlastik = KategoriPlastik::create($request->all());

        return redirect()->route('admin.kategori-plastiks.index');
    }

    public function edit(KategoriPlastik $kategoriPlastik)
    {
        abort_if(Gate::denies('kategori_plastik_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPlastiks.edit', compact('kategoriPlastik'));
    }

    public function update(UpdateKategoriPlastikRequest $request, KategoriPlastik $kategoriPlastik)
    {
        $kategoriPlastik->update($request->all());

        return redirect()->route('admin.kategori-plastiks.index');
    }

    public function show(KategoriPlastik $kategoriPlastik)
    {
        abort_if(Gate::denies('kategori_plastik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPlastiks.show', compact('kategoriPlastik'));
    }

    public function destroy(KategoriPlastik $kategoriPlastik)
    {
        abort_if(Gate::denies('kategori_plastik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriPlastik->delete();

        return back();
    }

    public function massDestroy(MassDestroyKategoriPlastikRequest $request)
    {
        KategoriPlastik::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
