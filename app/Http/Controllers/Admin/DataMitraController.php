<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DataMitra;
use App\Models\JenisPlastik;
use App\Models\JenisUsaha;
use App\Models\SumberSampah;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DataMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_mitras = DataMitra::with(['jenis_plastiks','jenis_usahas','sumber_sampahs','nama_users'])->orderBy('created_at','desc')->paginate(50);
        return view('admin.data-mitra.index',compact('data_mitras'));
    }

    /**
     * Show the form fdataor creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id');
        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');
        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');
        $nama_users = User::whereHas('roles', function (Builder $query) {
            $query->where('title', 'like', 'User');
        })->get();

        return view('admin.data-mitra.create',compact('jenis_usahas','jenis_plastiks','sumber_sampahs','nama_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_user' => [
                    'array',
                    'required',
                ],
                'nama_user.*' => [
                    'integer'
                ],
                'nama_mitra' => [
                    'required',
                    'unique:data_mitras,nama_mitra',
                ],
                'jenis_usaha_id' => [
                    'required',
                    'array',
                ],
                'jenis_usaha_id.*' => [
                    'integer'
                ],
                'alamat' => [
                    'string',
                    'required',
                ],
                'no_hp' => [
                    'integer',
                    'required',
                ],
                'jenis_plastiks.*' => [
                    'integer',
                ],
                'jenis_plastiks' => [
                    'array',
                    'required'
                ],
                'sumber_sampahs.*' => [
                    'integer',
                ],
                'sumber_sampahs' => [
                    'required',
                    'array',
                ],
                'lokasi_sumber_sampah' => [
                    'string',
                    'nullable',
                ],
            ]
        );
        $data_mitra = DataMitra::create($request->all());
        $data_mitra->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $data_mitra->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $data_mitra->jenis_usahas()->sync($request->input('jenis_usaha_id', []));
        $data_mitra->nama_users()->sync($request->input('nama_user', []));
        return redirect()->route('admin.data-mitra.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataMitra  $dataMitra
     * @return \Illuminate\Http\Response
     */
    public function show(DataMitra $dataMitra)
    {

        $dataMitra->load('jenis_usahas','jenis_plastiks','sumber_sampahs');
        return view('admin.data-mitra.show',compact('dataMitra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataMitra  $dataMitra
     * @return \Illuminate\Http\Response
     */
    public function edit(DataMitra $dataMitra)
    {
        $jenis_usahas = JenisUsaha::all()->pluck('nama_usaha', 'id');

        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');

        $sumber_sampahs = SumberSampah::all()->pluck('sumber_sampah', 'id');

        $nama_users = User::all()->pluck('name', 'id');

        $dataMitra->load('jenis_usahas','jenis_plastiks','sumber_sampahs','nama_users');


        return view('admin.data-mitra.edit',compact('dataMitra','jenis_usahas','jenis_plastiks','sumber_sampahs','nama_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataMitra  $dataMitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataMitra $dataMitra)
    {
        $validasi = $request->validate(
            [
                'nama_user' => [
                    'array',
                    'required',
                ],
                'nama_user.*' => [
                    'integer'
                ],
                'nama_mitra' => [
                    'required',
                    'unique:data_mitras,nama_mitra,' . $dataMitra->id,
                ],
                'jenis_usaha_id' => [
                    'required',
                    'array',
                ],
                'jenis_usaha_id.*' => [
                    'integer'
                ],
                'alamat' => [
                    'string',
                    'required',
                ],
                'no_hp' => [
                    'integer',
                    'required',
                ],
                'jenis_plastiks.*' => [
                    'integer',
                ],
                'jenis_plastiks' => [
                    'array',
                    'required'
                ],
                'sumber_sampahs.*' => [
                    'integer',
                ],
                'sumber_sampahs' => [
                    'required',
                    'array',
                ],
                'lokasi_sumber_sampah' => [
                    'string',
                    'nullable',
                ],
            ]
        );
        $dataMitra->update($request->all());
        $dataMitra->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $dataMitra->sumber_sampahs()->sync($request->input('sumber_sampahs', []));
        $dataMitra->jenis_usahas()->sync($request->input('jenis_usaha_id', []));
        return redirect()->route('admin.data-mitra.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataMitra  $dataMitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataMitra $dataMitra)
    {
        $dataMitra->delete();
        return back();
    }
}
