<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBuyerRequest;
use App\Http\Requests\StoreBuyerRequest;
use App\Http\Requests\UpdateBuyerRequest;
use App\Models\Buyer;
use App\Models\JenisPlastik;
use App\Models\JenisUsaha;
use App\Models\SumberSampah;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BuyerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('buyer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorize = Gate::inspect('admin-only');
        $buyers = Buyer::with(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users'])->paginate(50);
        if (! $authorize->allowed()){
            $buyers = Buyer::with(['jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users'])->whereHas('id_users', function ($query){
                $query->where('id','=',Auth::id());
            })->paginate(50);
        }
              
        return view('admin.buyers.index', compact('buyers'));
    }

    public function create()
    {
        abort_if(Gate::denies('buyer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');

        $id_users = User::all()->pluck('name', 'id');

        return view('admin.buyers.create', compact('jenis_usahas', 'jenis_plastiks', 'sumber_sampahs', 'id_users'));
    }

    public function store(StoreBuyerRequest $request)
    {

        $buyer = Buyer::create($request->all());
        $buyer->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $buyer->sumber_sampahs()->sync($request->input('sumber_sampahs', []));

        $authorize = Gate::inspect('admin-only');
        if ($authorize->allowed()) {
            $buyer->id_users()->sync($request->input('id_users', []));
        } else {
            $buyer->id_users()->sync(Auth::id(), []);
        }


        return redirect()->route('admin.buyers.index');
    }

    public function edit(Buyer $buyer)
    {
        abort_if(Gate::denies('buyer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');

        $id_users = User::all()->pluck('name', 'id');

        $buyer->load('jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users');

        return view('admin.buyers.edit', compact('jenis_usahas', 'jenis_plastiks', 'sumber_sampahs', 'id_users', 'buyer'));
    }

    public function update(UpdateBuyerRequest $request, Buyer $buyer)
    {
        $buyer->update($request->all());
        $buyer->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $buyer->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $buyer->id_users()->sync($request->input('id_users', []));
        return redirect()->route('admin.buyers.index');
    }

    public function show(Buyer $buyer)
    {
        abort_if(Gate::denies('buyer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buyer->load('jenis_usaha', 'jenis_plastiks', 'sumber_sampahs', 'id_users');

        return view('admin.buyers.show', compact('buyer'));
    }

    public function destroy(Buyer $buyer)
    {
        abort_if(Gate::denies('buyer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buyer->delete();

        return back();
    }

    public function massDestroy(MassDestroyBuyerRequest $request)
    {
        Buyer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
