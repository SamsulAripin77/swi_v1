<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPembelianRequest;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use App\Models\JenisPlastik;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\User;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pembelian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $nama_users =  User::with(['roles'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('Semua'), 'semua');
        
        $pembelians = $this->getPembelians($request);
        $aggregate = $this->aggregate();
        // return $pembelians;
        return view('admin.pembelians.index', compact('pembelians','aggregate','nama_users'));
    }

    public function exportExcel(Request $request){
        if(Auth::user()->roles->where('title', '=', 'User Monitor')->count() > 0){
            abort(404);
        }
        $transaksis = $this->getPembelians($request);
        $auth = User::find(Auth::id());
        $authorize = Gate::inspect('admin-only');
        $plastiks = $auth->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->get();
        
        if($authorize->allowed()){
            $plastiks = JenisPlastik::where('nama_plastik', '!=', 'produk hasil olahan')->get();
        }

        $label = 'pembelian';
        $nama_users =  User::with(['roles'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('Semua'), 'semua');
        
        // return $plastiks;
        return view('admin.exports.export',compact('transaksis','plastiks','label','nama_users'));
    }

     private function getPembelians ($request){
        abort_if(Gate::denies('pembelian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::findOrFail(Auth::id());
        $authorize = Gate::inspect('admin-only');
        $autUserMonitor = Gate::inspect('user-monitor');
        $filterUser = $request->get('user_id');

        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if ($authorize->allowed() || $autUserMonitor->allowed()) {
                     
                if ($filterUser && $filterUser !== 'semua' && $start && $end)
                {
                    // return '1';
                    $pembelians = Pembelian::where('created_by_id', '=', $filterUser)->whereBetween('tgl_beli', [$start, $end])->with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();   
                }
                else if ($start && $end) {
                    // return '2';
                    $pembelians = Pembelian::whereBetween('tgl_beli', [$start, $end])->with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();  
                }
                else if ($filterUser && $filterUser !== 'semua') {
                    // return '3';
                    $pembelians = Pembelian::where('created_by_id', '=', $filterUser)->with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();
                }else {
                    // return '4';
                    $pembelians = Pembelian::with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();
                }      
            return $pembelians;   
            // return view('admin.pembelians.index', compact('pembelians', 'nama_users'));
        } else {
            if ($start && $end) {
                // return '5';
                $pembelians = Pembelian::where('created_by_id', '=', Auth::id())->whereBetween('tgl_beli', [$start, $end])->with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get(); 
            }
            else {
                // return '6';
                $pembelians = Pembelian::where('created_by_id', '=', Auth::id())->with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get(); 
            }
        }

        return $pembelians;
        // return view('admin.pembelians.index', compact('pembelians','aggregate'));
    }

    public function create()
    {
        abort_if(Gate::denies('pembelian_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $auth = User::find(Auth::id());
        $nama_suppliers = $auth->supplier->pluck('nama_supplier', 'id')->prepend(trans('global.pleaseSelect'), '');
       
        $nama_plastiks = $auth->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->pluck('nama_plastik', 'id');


        $auth = Gate::inspect('super-admin');
        if ($auth->allowed()) {
            $nama_suppliers = Supplier::all()->pluck('nama_supplier', 'id')->prepend(trans('global.pleaseSelect'), '');;
            return view('admin.pembelians.create', compact('nama_suppliers', 'nama_plastiks'));
        }

        return view('admin.pembelians.create', compact('nama_suppliers', 'nama_plastiks'));
    }

    public function store(StorePembelianRequest $request)
    {
        $data = $request->validated();
        $total_berat = $this->getTotalBerat($data['nama_plastiks']);
        $pembelian = Pembelian::create(['created_by_id' => Auth::user()->id,'total_berat' => $total_berat] + $data);
        $pembelian->nama_plastiks()->sync($this->mapPlastiks($data['nama_plastiks']));

        foreach ($request->input('photo_manifes', []) as $file) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_manifes');
        }

        foreach ($request->input('photo', []) as $file) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pembelian->id]);
        }

        // return response()->json($data);
        return redirect()->route('admin.pembelians.index');
    }

    public function edit(Pembelian $pembelian)
    {
        $this->authorize('view', $pembelian);
        abort_if(Gate::denies('pembelian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::findOrFail(Auth::id());
        $nama_suppliers = $user->supplier->pluck('nama_supplier', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auth = User::find(Auth::id());

        $plastiks = $auth->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->get();

        $nama_plastiks = $plastiks->map(function ($nama_plastik) use ($pembelian) {
            $nama_plastik->berat = data_get($pembelian->nama_plastiks->firstWhere('id', $nama_plastik->id), 'pivot.berat') ?? null;
            return $nama_plastik;
        });
        $pembelian->load('nama_supplier');

        $auth = Gate::inspect('super-admin');
        if ($auth->allowed()) {
            $nama_suppliers = Supplier::all()->pluck('nama_supplier', 'id')->prepend(trans('global.pleaseSelect'), '');;
            return view('admin.pembelians.edit', compact('nama_suppliers', 'nama_plastiks', 'pembelian'));
        }

        // return $pembelian;
        return view('admin.pembelians.edit', compact('nama_suppliers', 'nama_plastiks', 'pembelian'));
        // return $plastiks;
    }

    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        $this->authorize('update', $pembelian);
        $data = $request->validated();
        $total_berat = $this->getTotalBerat($data['nama_plastiks']);
        $pembelian->update(['total_berat' => $total_berat],$data);
        $pembelian->nama_plastiks()->sync($this->mapPlastiks($data['nama_plastiks']));

        //foto manifes
        if (count($pembelian->photo_manifes) > 0) {
            foreach ($pembelian->photo_manifes as $media) {
                if (!in_array($media->file_name, $request->input('photo_manifes', []))) {
                    $media->delete();
                }
            }
        }

        $media = $pembelian->photo_manifes->pluck('file_name')->toArray();

        foreach ($request->input('photo_manifes', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo_manifes');
            }
        }


        //foto
        if (count($pembelian->photo) > 0) {
            foreach ($pembelian->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $pembelian->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        if ($request->input('video', false)) {
            if (!$pembelian->video || $request->input('video') !== $pembelian->video->file_name) {
                if ($pembelian->video) {
                    $pembelian->video->delete();
                }

                $pembelian->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($pembelian->video) {
            $pembelian->video->delete();
        }

        return redirect()->route('admin.pembelians.index');
    }

    public function show(Pembelian $pembelian)
    {
        abort_if(Gate::denies('pembelian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $pembelian->load('nama_supplier', 'nama_plastiks');

        return view('admin.pembelians.show', compact('pembelian'));
    }

    public function destroy(Pembelian $pembelian)
    {
        $this->authorize('delete', $pembelian);
        abort_if(Gate::denies('pembelian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembelian->delete();

        return back();
    }


    public function massDestroy(MassDestroyPembelianRequest $request)
    {
        Pembelian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pembelian_create') && Gate::denies('pembelian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pembelian();
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
        $nama_plastiks = $user->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->pluck('nama_plastik', 'id')->prepend(trans('Semua'), 'semua');

        $auth = Gate::inspect('admin-only');
        $autUserMonitor = Gate::inspect('user-monitor');
        $query = null;

        $nama_users =  User::with(['roles'])->whereHas('roles', function (Builder $query) {
            $query->where('title', '=', 'User');
        })->pluck('name', 'id')->prepend(trans('semua'), 'semua');

        $filterUser = $request->get('user_id');
        $plastik_id = $request->get('plastik_id');

        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if ($auth->allowed() || $autUserMonitor->allowed()) {
            //admin
            if ($filterUser == 'semua'){
                $query = $this->customQuery()
                ->get();
            }
            else if ($filterUser !=='semua' && $request->input('start_date') && $request->input('end_date')){
                $query = $this->customQuery()
                    ->whereBetween('tgl_beli', [$start, $end])
                    ->where('pembelians.created_by_id', '=', $filterUser)
                    ->orderBy('pembelians.tgl_beli','asc')
                    ->get();

            }
            else if ($filterUser) {
                $query = $this->customQuery()
                ->where('pembelians.created_by_id', '=', $filterUser)
                ->get();
            }else if ($request->input('start_date') && $request->input('end_date')) {
                $query = $this->customQuery()
                    ->whereBetween('tgl_beli', [$start, $end])
                    ->orderBy('pembelians.tgl_beli','asc')
                    ->get();
            } else {
                $query = $this->customQuery()
                ->get();
            }
        } else {
            if($plastik_id !== 'semua' && $request->input('start_date') && $request->input('end_date'))
            {
                // return 'satu';
                $query = $this->customQuery()
                ->where('pembelians.created_by_id', '=', Auth::id())
                ->whereBetween('tgl_beli', [$start, $end])
                ->where('jenis_plastik_pembelian.jenis_plastik_id','=', $plastik_id)
                ->orderBy('pembelians.tgl_beli','asc')
                ->get();
            }
            else if ($request->input('start_date') && $request->input('end_date')) {
                // return 'dua';
                $query = $this->customQuery()
                    ->where('pembelians.created_by_id', '=', Auth::id())
                    ->whereBetween('tgl_beli', [$start, $end])
                    ->orderBy('pembelians.tgl_beli','asc')
                    ->get();
            }
            else if ($plastik_id && $plastik_id !== 'semua') {
                // return 'tiga';
                $query = $this->customQuery()
                ->where('pembelians.created_by_id', '=', Auth::id())
                ->where('jenis_plastik_pembelian.jenis_plastik_id','=', $plastik_id)
                ->orderBy('pembelians.tgl_beli','asc')
                ->get();
            }else {
                // return 'empat';
                $query = $this->customQuery()
                ->where('pembelians.created_by_id', '=', Auth::id())
                ->orderBy('pembelians.tgl_beli','asc')
                ->get();
            }

        }
       
        $transaksis = $this->laporanQuery($query);
        $label = 'Supplier';

        return view('admin.laporan', compact('transaksis', 'label','nama_users','nama_plastiks'));
    }

    private function laporanQuery($query)
    {
        return $query->map(function ($item) {
            $media = Pembelian::find($item->id);
            $data = $item;
            $data->photo = count($media->photo) > 0 ? 'yes' : 'no';
            $data->manifes = count($media->photo_manifes)  > 0 ? 'yes' : 'no';
            $data->video = $media->video !== null ? 'yes' : 'no';
            return $data;
        });
    }

    private function customQuery()
    {
        return  $query  = DB::table('pembelians')
            ->selectRaw(
                ' 
                    pembelians.id as id,
                    tgl_beli,
                    users.name as name,
                    jenis_plastiks.nama_plastik as plastik,
                    jenis_plastik_pembelian.berat as berat,
                    suppliers.nama_supplier as supplier
                    '
            )
            
            ->join('users', 'users.id', '=', 'pembelians.created_by_id')
            ->join('jenis_plastik_pembelian', 'jenis_plastik_pembelian.pembelian_id', '=', 'pembelians.id')
            ->join('jenis_plastiks', 'jenis_plastiks.id', '=', 'jenis_plastik_pembelian.jenis_plastik_id')
            ->join('suppliers', 'suppliers.id', '=', 'pembelians.nama_supplier_id')
            ->where('jenis_plastik_pembelian.berat', '>', 0)
            ->whereNull('pembelians.deleted_at');
    }

    private function aggregate() {
        $query  = DB::table('jenis_plastiks')
        ->selectRaw('
                    nama_plastik,
                    SUM(jenis_plastik_pembelian.berat) as pengumpulan
                    '
                    )
        ->join('jenis_plastik_pembelian',  'jenis_plastik_pembelian.jenis_plastik_id', '=', 'jenis_plastiks.id')
        ->join('pembelians', 'pembelians.id', '=', 'jenis_plastik_pembelian.pembelian_id')
        ->join('users', 'pembelians.created_by_id', '=', 'users.id')

        ->where('pembelians.deleted_at', '=', null)
        ->where('users.id','=', Auth::id())
        ->groupBy('nama_plastik')
        ->get();

        return $query;
    }


}
