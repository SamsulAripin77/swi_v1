<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJenisUsahaRequest;
use App\Http\Requests\StoreJenisUsahaRequest;
use App\Http\Requests\UpdateJenisUsahaRequest;
use App\Models\JenisUsaha;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisUsahaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_usaha_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsahas = JenisUsaha::all();

        return view('admin.jenisUsahas.index', compact('jenisUsahas'));
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_usaha_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisUsahas.create');
    }

    public function store(StoreJenisUsahaRequest $request)
    {
        $jenisUsaha = JenisUsaha::create($request->all());

        return redirect()->route('admin.jenis-usahas.index');
    }

    public function edit(JenisUsaha $jenisUsaha)
    {
        abort_if(Gate::denies('jenis_usaha_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisUsahas.edit', compact('jenisUsaha'));
    }

    public function update(UpdateJenisUsahaRequest $request, JenisUsaha $jenisUsaha)
    {
        $jenisUsaha->update($request->all());

        return redirect()->route('admin.jenis-usahas.index');
    }

    public function show(JenisUsaha $jenisUsaha)
    {
        abort_if(Gate::denies('jenis_usaha_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisUsahas.show', compact('jenisUsaha'));
    }

    public function destroy(JenisUsaha $jenisUsaha)
    {
        abort_if(Gate::denies('jenis_usaha_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsaha->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisUsahaRequest $request)
    {
        JenisUsaha::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
