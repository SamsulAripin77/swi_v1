<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kemitraan;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\{JenisPlastik,DataMitra,User};
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Gate;

class KemitraanController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //    $mitra = Gate::inspect('mitra-only');
    //    if (! $mitra->allowed()){
    //     abort(404);
    //    }
    // }

    public function index()
    {
        //
        $kemitraans = Kemitraan::with(['jenis_plastiks'])->orderBy('created_at','desc')->paginate(50);
        return view('admin.kemitraan.index',compact('kemitraans'));
    }

    /**p
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama_mitras = DataMitra::all();
        $nama_users = User::whereHas('roles', function (Builder $query) {
            $query->where('title', 'like', 'User');
        })->get();
        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');
        return view('admin.kemitraan.create',compact('jenis_plastiks','nama_users','jenis_plastiks','nama_mitras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => ['array','required'],
            'nama.*' => ['integer'],
            'tgl_beli' => 'required',
            'nama_mitra' => ['integer','required','unique:kemitraans,nama_mitra'],
            'total_berat' => ['integer','required'],
            'menyetujui' => ['integer','required'],
            'jenis_plastiks' => ['array','required'],
            'jenis_plastiks.*' => ['integer']]);

        $kemitraan = Kemitraan::create($request->all());
        $kemitraan->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $kemitraan->nama_users()->sync($request->input('nama', []));

        foreach ($request->input('photo', []) as $file) {
            $kemitraan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $kemitraan->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $kemitraan->id]);
        }
        return redirect()->route('admin.kemitraan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kemitraan  $kemitraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kemitraan $kemitraan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kemitraan  $kemitraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kemitraan $kemitraan)
    {
        $nama_mitras = DataMitra::all()->pluck('nama_mitra','id');
        $nama_users = User::whereHas('roles', function (Builder $query) {
            $query->where('title', 'like', 'User');
        })->pluck('name','id');
        $jenis_plastiks = JenisPlastik::all()->pluck('nama_plastik', 'id');
        $kemitraan->load('jenis_plastiks','nama_mitras','nama_users');
        // return $kemitraan;
        return view('admin.kemitraan.edit',compact('kemitraan','nama_users','jenis_plastiks','nama_mitras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kemitraan  $kemitraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kemitraan $kemitraan)
    {
        $validasi = $request->validate([
            'nama' => ['array','required'],
            'nama.*' => ['integer'],
            'tgl_beli' => 'required',
            'nama_mitra' => ['integer','required','unique:kemitraans,nama_mitra,'. $kemitraan->id],
            'total_berat' => ['integer','required'],
            'menyetujui' => ['integer','required'],
            'jenis_plastiks' => ['array','required'],
            'jenis_plastiks.*' => ['integer']]);
        $kemitraan->update($request->all());
        $kemitraan->jenis_plastiks()->sync($request->input('jenis_plastiks', []));
        $kemitraan->nama_users()->sync($request->input('nama', []));

        if (count($kemitraan->photo) > 0) {
            foreach ($kemitraan->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $kemitraan->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $kemitraan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        if ($request->input('video', false)) {
            if (!$kemitraan->video || $request->input('video') !== $kemitraan->video->file_name) {
                if ($kemitraan->video) {
                    $kemitraan->video->delete();
                }

                $kemitraan->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($kemitraan->video) {
            $kemitraan->video->delete();
        }
        return redirect()->route('admin.kemitraan.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kemitraan  $kemitraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kemitraan $kemitraan)
    {
        $kemitraan->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('pembelian_create') && Gate::denies('pembelian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Kemitraan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
