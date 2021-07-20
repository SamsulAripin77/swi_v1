<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySumberSampahRequest;
use App\Http\Requests\StoreSumberSampahRequest;
use App\Http\Requests\UpdateSumberSampahRequest;
use App\Models\SumberSampah;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SumberSampahController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sumber_sampah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sumberSampahs = SumberSampah::all();

        return view('admin.sumberSampahs.index', compact('sumberSampahs'));
    }

    public function create()
    {
        abort_if(Gate::denies('sumber_sampah_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sumberSampahs.create');
    }

    public function store(StoreSumberSampahRequest $request)
    {
        $sumberSampah = SumberSampah::create($request->all());

        return redirect()->route('admin.sumber-sampahs.index');

    }

    public function storeAjax(Request $request)
    {
        $sumberSampah = SumberSampah::create($request->all());
        $sampah = SumberSampah::latest()->take(1)->get();

        return response()->json(['sampah'=> $sampah]);
    }

    public function edit(SumberSampah $sumberSampah)
    {
        abort_if(Gate::denies('sumber_sampah_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sumberSampahs.edit', compact('sumberSampah'));
    }

    public function update(UpdateSumberSampahRequest $request, SumberSampah $sumberSampah)
    {
        $sumberSampah->update($request->all());

        return redirect()->route('admin.sumber-sampahs.index');
    }

    public function show(SumberSampah $sumberSampah)
    {
        abort_if(Gate::denies('sumber_sampah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sumberSampahs.show', compact('sumberSampah'));
    }

    public function destroy(SumberSampah $sumberSampah)
    {
        abort_if(Gate::denies('sumber_sampah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sumberSampah->delete();

        return back();
    }

    public function massDestroy(MassDestroySumberSampahRequest $request)
    {
        SumberSampah::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
