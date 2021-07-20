<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPenjualanRequest;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Buyer;
use App\Models\JenisPlastik;
use App\Models\KategoriPlastik;
use App\Models\Penjualan;
use App\Models\User;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('penjualan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $nama_users =  User::with(['roles','nama_plastiks'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('semua'), 'semua');
        $penjualans = $this->getPenjualans($request);
        $aggregate = $this->aggregate();
       
        return view('admin.penjualans.index', compact('penjualans','aggregate','nama_users'));
    }

    private function getPenjualans ($request) {
        abort_if(Gate::denies('penjualan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $authorize = Gate::inspect('admin-only');
        $autUserMonitor = Gate::inspect('user-monitor');
        $nama_users =  User::with(['roles','nama_plastiks'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('semua'), 'semua');
        $filterUser = $request->get('user_id');

        $start = $request->input('start_date');
        $end = $request->input('end_date');
        
        if ($authorize->allowed() || $autUserMonitor->allowed()) {          

                if ($filterUser && $filterUser !== 'semua' && $start && $end)
                {
                    // return '1';
                    $penjualans = Penjualan::where('created_by_id', '=', $filterUser)->whereBetween('tgl_jual', [$start, $end])->with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get();   
                }
                else if ($start && $end) {
                    // return '2';
                    $penjualans = Penjualan::whereBetween('tgl_jual', [$start, $end])->with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get();  
                }
                else if ($filterUser && $filterUser !== 'semua') {
                    // return '3';
                    $penjualans = Penjualan::where('created_by_id', '=', $filterUser)->with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get();
                }else {
                    // return '4';
                    $penjualans = Penjualan::with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get();
                }         
                return $penjualans;
            // return view('admin.penjualans.index', compact('penjualans', 'nama_users'));
        } else {
            if ($start && $end) {
                // return '5';
                $penjualans = Penjualan::where('created_by_id', '=', Auth::id())->whereBetween('tgl_jual', [$start, $end])->with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get(); 
            }
            else {
                // return '6';
                $penjualans = Penjualan::where('created_by_id', '=', Auth::id())->with(['nama_buyer', 'nama_plastiks', 'media'])->orderBy('tgl_jual')->get(); 
            }
        }
        return $penjualans;
    }

    public function create()
    {
        abort_if(Gate::denies('penjualan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPabrik = Gate::inspect('pabrikan-only');


        $auth = User::find(Auth::id());
        $nama_plastiks = $auth->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->pluck('nama_plastik', 'id');
        if ($isPabrik->allowed()) {
            $nama_plastiks = $auth->nama_plastiks()->where('nama_plastik', '=', 'produk hasil olahan')->pluck('nama_plastik', 'id');
        }

        $user = User::findOrFail(Auth::id());
        $nama_buyers = $user->buyers->pluck('nama_buyer', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = Gate::inspect('super-admin');
        if ($auth->allowed()) {
            $nama_buyers = Buyer::all()->pluck('nama_buyer', 'id')->prepend(trans('global.pleaseSelect'), '');;
            return view('admin.penjualans.create', compact('nama_buyers', 'nama_plastiks'));
        }
        // return $nama_plastiks;
        return view('admin.penjualans.create', compact('nama_buyers', 'nama_plastiks'));
    }

    public function store(StorePenjualanRequest $request)
    {
        $data = $request->validated();
        $total_berat = $this->getTotalBerat($data['nama_plastiks']);
        $penjualan = Penjualan::create(['created_by_id' => Auth::user()->id,'total_berat' => $total_berat] + $data);
        $penjualan->nama_plastiks()->sync($this->mapPlastiks($data['nama_plastiks']));

        foreach ($request->input('photo_manifes', []) as $file) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_manifes');
        }

        foreach ($request->input('photo', []) as $file) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $penjualan->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $penjualan->id]);
        }

        return redirect()->route('admin.penjualans.index');
    }

    public function edit(Penjualan $penjualan)
    {
        $this->authorize('update', $penjualan);
        abort_if(Gate::denies('penjualan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPabrikan = Gate::inspect('pabrikan-only');
        $isAdmin = Gate::inspect('admin-only');

        $auth = User::find(Auth::id());

        $plastiks = $auth->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->get();

        if ($isPabrikan->allowed()) {
            $plastiks = $auth->nama_plastiks()->where('nama_plastik', '=', 'produk hasil olahan')->get();
        }

        $user = User::findOrFail(Auth::id());
        $nama_buyers = $user->buyers->pluck('nama_buyer', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_plastiks = $plastiks->map(function ($nama_plastik) use ($penjualan) {
            $nama_plastik->berat = data_get($penjualan->nama_plastiks->firstWhere('id', $nama_plastik->id), 'pivot.berat') ?? null;
            return $nama_plastik;
        });

        $penjualan->load('nama_buyer');

        $auth = Gate::inspect('super-admin');
        if ($auth->allowed()) {
            $nama_buyers = Buyer::all()->pluck('nama_buyer', 'id')->prepend(trans('global.pleaseSelect'), '');;
            return view('admin.penjualans.edit', compact('nama_buyers', 'penjualan', 'nama_plastiks'));
        }

        return view('admin.penjualans.edit', compact('nama_buyers', 'penjualan', 'nama_plastiks'));
        // return $penjualan;
    }

    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        $this->authorize('update', $penjualan);
        $data = $request->validated();
        $total_berat = $this->getTotalBerat($data['nama_plastiks']);
        $penjualan->update(['total_berat' => $total_berat] + $data);
        $penjualan->nama_plastiks()->sync($this->mapPlastiks($data['nama_plastiks']));

        //photo manifes
        if (count($penjualan->photo_manifes) > 0) {
            foreach ($penjualan->photo_manifes as $media) {
                if (!in_array($media->file_name, $request->input('photo_manifes', []))) {
                    $media->delete();
                }
            }
        }

        $media = $penjualan->photo_manifes->pluck('file_name')->toArray();

        foreach ($request->input('photo_manifes', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $penjualan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_manifes');
            }
        }

        //photo
        if (count($penjualan->photo) > 0) {
            foreach ($penjualan->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $penjualan->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $penjualan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
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

        return redirect()->route('admin.penjualans.index');
    }

    public function show(Penjualan $penjualan)
    {

        abort_if(Gate::denies('penjualan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penjualan->load('nama_buyer', 'nama_plastiks');

        return view('admin.penjualans.show', compact('penjualan'));
    }

    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        abort_if(Gate::denies('penjualan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $penjualan->delete();
        return back();
    }

    public function massDestroy(MassDestroyPenjualanRequest $request)
    {
        Penjualan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('penjualan_create') && Gate::denies('penjualan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Penjualan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    private function mapPlastiks($plastiks)
    {
        return collect($plastiks)->map(function ($i) {
            return ['berat' => $i];
        });
    }

    private function getTotalBerat($plastiks,$j=0){
        foreach ($plastiks as $key => $value){
            $j += $value;
        }
        return $j;
    }

    public function dynamicKategoriPlastik(Request $request)
    {

        $plastik_id = $request->plastik_id;

        $plastiks = JenisPlastik::where('kategori_plastik_id', $plastik_id)->get();

        return response()->json([
            'plastiks' => $plastiks
        ]);
    }

    public function laporan(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $nama_plastiks = $user->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->pluck('nama_plastik', 'id')->prepend(trans('Semua'), 'semua');;

        $auth = Gate::inspect('admin-only');
        $query = null;

        $nama_users =  User::with(['roles'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('Semua'), 'semua');

        $autUserMonitor = Gate::inspect('user-monitor');

        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $filterUser = $request->get('user_id');
        $plastik_id = $request->get('plastik_id');

        if ($auth->allowed() || $autUserMonitor->allowed()) {
           //admin
            if ($filterUser == 'semua'){
                $query = $this->customQuery()
                ->get();
            } else if ($request->input('start_date') && $request->input('end_date')) {
                $query = $this->customQuery()
                    ->whereBetween('tgl_jual', [$start, $end])
                    ->where('penjualans.created_by_id', '=', $filterUser)
                    ->orderBy('penjualans.tgl_jual','asc')
                    ->get();
            } 
            else if ($filterUser) {
                $query = $this->customQuery()
                ->where('penjualans.created_by_id', '=', $filterUser)
                ->get();
            }else if ($request->input('start_date') && $request->input('end_date')) {
                $query = $this->customQuery()
                    ->whereBetween('tgl_jual', [$start, $end])
                    ->orderBy('penjualans.tgl_jual','asc')
                    ->get();
            } 
            else {
                $query = $this->customQuery()
                ->take(50)->get();
            }
        } else {
            if($plastik_id !== 'semua' &&  $plastik_id && $request->input('start_date') && $request->input('end_date'))
            {
                $query = $this->customQuery()
                ->where('penjualans.created_by_id', '=', Auth::id())
                ->whereBetween('tgl_jual', [$start, $end])
                ->where('jenis_plastik_penjualan.jenis_plastik_id','=', $plastik_id)
                ->orderBy('penjualans.tgl_jual','asc')
                ->get();
            }
            else if ($request->input('start_date') && $request->input('end_date')) {
                $query = $this->customQuery()
                    ->where('penjualans.created_by_id', '=', Auth::id())
                    ->whereBetween('tgl_jual', [$start, $end])
                    ->orderBy('penjualans.tgl_jual','asc')
                    ->get();
            }else if ($plastik_id && $plastik_id !== 'semua') {
                    $query = $this->customQuery()
                    ->where('penjualans.created_by_id', '=', Auth::id())
                    ->where('jenis_plastik_penjualan.jenis_plastik_id','=', $plastik_id)
                    ->orderBy('penjualans.tgl_jual','asc')
                    ->get();
            }else {
                $query = $this->customQuery()
                ->where('penjualans.created_by_id', '=', Auth::id())
                ->orderBy('penjualans.tgl_jual','asc')
                ->get();
            }
        }

        $transaksis = $this->laporanQuery($query);
        $label = 'Buyer';
    
        return view('admin.laporan', compact('transaksis', 'label','nama_users','nama_plastiks'));
    }

    private function laporanQuery($query)
    {
        return $query->map(function ($item) {
            $media = Penjualan::find($item->id);
            $data = $item;
            $data->photo = count($media->photo) > 0 ? 'yes' : 'no';
            $data->manifes = count($media->photo_manifes)  > 0 ? 'yes' : 'no';
            $data->video = $media->video !== null ? 'yes' : 'no';
            return $data;
        });
    }

    private function customQuery()
    {
        return $query  = DB::table('penjualans')
            ->selectRaw(
                '
                    penjualans.id as id,
                    tgl_jual,
                    users.name as name,
                    jenis_plastiks.nama_plastik as plastik,
                    jenis_plastik_penjualan.berat as berat,
                    buyers.nama_buyer as buyer
                    '
            )
            ->whereNull('penjualans.deleted_at')
            ->join('users', 'users.id', '=', 'penjualans.created_by_id')
            ->join('jenis_plastik_penjualan', 'jenis_plastik_penjualan.penjualan_id', '=', 'penjualans.id')
            ->join('jenis_plastiks', 'jenis_plastiks.id', '=', 'jenis_plastik_penjualan.jenis_plastik_id')
            ->join('buyers', 'buyers.id', '=', 'penjualans.nama_buyer_id');
    }

    private function aggregate() {
        $query  = DB::table('jenis_plastiks')
        ->selectRaw('
                    nama_plastik,
                    SUM(jenis_plastik_penjualan.berat) as pengumpulan
                    '
                    )
        ->join('jenis_plastik_penjualan',  'jenis_plastik_penjualan.jenis_plastik_id', '=', 'jenis_plastiks.id')
        ->join('penjualans', 'penjualans.id', '=', 'jenis_plastik_penjualan.penjualan_id')
        ->join('users', 'penjualans.created_by_id', '=', 'users.id')

        ->where('penjualans.deleted_at', '=', null)
        ->where('users.id','=', Auth::id())
        ->groupBy('nama_plastik')
        ->get();

        return $query;
    }
}
