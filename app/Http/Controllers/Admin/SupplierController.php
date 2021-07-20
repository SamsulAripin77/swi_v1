<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\JenisPlastik;
use App\Models\JenisUsaha;
use App\Models\SumberSampah;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $authorize = Gate::inspect('admin-only');
        $suppliers = Supplier::with(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users'])->paginate(50);
        if (! $authorize->allowed()){
            $suppliers = Supplier::with(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users'])->whereHas('id_users', function ($query){
                $query->where('id','=',Auth::id());
            })->paginate(50);
        }
              

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_plastiks = JenisPlastik::where('nama_plastik', '!=', 'produk hasil olahan')->pluck('nama_plastik', 'id');

        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');

        $id_users = User::all()->pluck('name', 'id');

        return view('admin.suppliers.create', compact('jenis_usahas', 'jenis_plastiks', 'sumber_sampahs', 'id_users'));
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());
        $supplier->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $supplier->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $authorize = Gate::inspect('admin-only');
        if ($authorize->allowed()) {
            $supplier->id_users()->sync($request->input('id_users', []));
        } else {
            $supplier->id_users()->sync(Auth::id());
        }

        return redirect()->route('admin.suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');

        $id_users = User::all()->pluck('name', 'id');

        $supplier->load('jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users');

        return view('admin.suppliers.edit', compact('jenis_usahas', 'jenis_plastiks', 'sumber_sampahs', 'id_users', 'supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        $supplier->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $supplier->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $supplier->id_users()->sync($request->input('id_users', []));

        return redirect()->route('admin.suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier->load('jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users');

        return view('admin.suppliers.show', compact('supplier'));
    }

    public function destroy(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplier->delete();

        return back();
    }

    public function massDestroy(MassDestroySupplierRequest $request)
    {
        Supplier::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
