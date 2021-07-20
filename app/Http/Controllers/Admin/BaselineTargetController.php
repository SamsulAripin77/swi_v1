<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBaselineTargetRequest;
use App\Http\Requests\StoreBaselineTargetRequest;
use App\Http\Requests\UpdateBaselineTargetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BaselineTarget;
use App\Models\JenisPlastik;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Builder;

class BaselineTargetController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('baseline_target_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baselineTargets = BaselineTarget::with(['nama_user', 'nama_plastiks'])->paginate(50);

        return view('admin.baselineTargets.index', compact('baselineTargets'));
    }

    public function create()
    {
        abort_if(Gate::denies('baseline_target_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_users = User::whereHas('roles', function (Builder $query) {
            $query->where('title', 'like', 'User');
        })->get();
        // $nama_users = User::
        $auth = User::find(Auth::id());

        return view('admin.baselineTargets.create', compact('nama_users'));
    }

    public function store(StoreBaselineTargetRequest $request)
    {
        $data = $request->validated();

        $baselineTarget = BaselineTarget::create($data);
        foreach ($request->nama_plastiks as $id => $plastik) {
            $baselineTarget->nama_plastiks()->attach($id, array('baseline' => $plastik, 'target' => $request['target' . $id], 'insentif' =>  $request['insentif' . $id]));
        }

        return redirect()->route('admin.baseline-targets.index');
        // return response()->json($data);
    }

    public function edit(BaselineTarget $baselineTarget)
    {
        abort_if(Gate::denies('baseline_target_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $user = User::findOrfail($baselineTarget->nama_user->id);
        $plastiks = $user->nama_plastiks()->where('nama_plastik', '!=', 'produk hasil olahan')->get();

        $nama_plastiks = $plastiks->map(function ($nama_plastik) use ($baselineTarget) {
            $nama_plastik->baseline = data_get($baselineTarget->nama_plastiks->firstWhere('id', '=', $nama_plastik->id), 'pivot.baseline') ?? null;
            $nama_plastik->target = data_get($baselineTarget->nama_plastiks->firstWhere('id', $nama_plastik->id), 'pivot.target') ?? null;
            $nama_plastik->insentif = data_get($baselineTarget->nama_plastiks->firstWhere('id', $nama_plastik->id), 'pivot.insentif') ?? null;
            return $nama_plastik;
        });

        $baselineTarget->load('nama_user', 'nama_plastiks');

        // return $nama_plastiks;


        return view('admin.baselineTargets.edit', compact('nama_users', 'nama_plastiks', 'baselineTarget'));
    }

    public function update(UpdateBaselineTargetRequest $request, BaselineTarget $baselineTarget)
    {
        $data = $request->validated(['nama_user_id' => [
            'required',
            "unique:baseline_targets," . $baselineTarget->id,
        ]]);
        $baselineTarget->update($request->all());

        foreach ($request->nama_plastiks as $id => $nama_plastik) {
            if (!$baselineTarget->nama_plastiks()->where('jenis_plastik_id', $id)->exists()) {
                $baselineTarget->nama_plastiks()->attach($id, array(
                    'baseline' => $nama_plastik,
                    'target' => $request->input('target' . $id),
                    'insentif' =>  $request->input('insentif' . $id)
                ));
            }

            $baselineTarget->nama_plastiks()->updateExistingPivot(
                $id,
                array(
                    'baseline' => $nama_plastik,
                    'target' => $request->input('target' . $id),
                    'insentif' =>  $request->input('insentif' . $id)
                )
            );
        }
        // return $data;
        return redirect()->route('admin.baseline-targets.index');
        // return response()->json($request->input('nama_plastiks'));
    }

    public function show(BaselineTarget $baselineTarget)
    {
        abort_if(Gate::denies('baseline_target_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baselineTarget->load('nama_user', 'nama_plastiks');

        return view('admin.baselineTargets.show', compact('baselineTarget'));
    }

    public function destroy(BaselineTarget $baselineTarget)
    {
        abort_if(Gate::denies('baseline_target_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baselineTarget->delete();

        return back();
    }

    public function laporan()
    {
        $query  = DB::table('jenis_plastiks')
            ->selectRaw(
                '
                        nama_plastik,
                        users.name as name,
                        baseline_target_jenis_plastik.baseline as baseline,
                        baseline_target_jenis_plastik.target as target,
                        baseline_target_jenis_plastik.insentif as insentif_kg,
                        SUM(jenis_plastik_pembelian.berat) as pengumpulan,
                        users.id as user_id,
                        pembelians.created_by_id as pembelian_user,
                        baseline_targets.nama_user_id as baseline_user
                        '
            )
            ->join('jenis_plastik_pembelian',  'jenis_plastik_pembelian.jenis_plastik_id', '=', 'jenis_plastiks.id')
            ->join('pembelians', 'pembelians.id', '=', 'jenis_plastik_pembelian.pembelian_id')
            ->join('baseline_target_jenis_plastik', 'baseline_target_jenis_plastik.jenis_plastik_id', '=', 'jenis_plastiks.id')
            ->join('baseline_targets', function ($join) {
                $join->on('baseline_targets.id', '=', 'baseline_target_jenis_plastik.baseline_target_id');
                $join->on('baseline_targets.nama_user_id', '=', 'pembelians.created_by_id');
            })
            ->join('users', 'baseline_targets.nama_user_id', '=', 'users.id')

            ->where('pembelians.deleted_at', '=', null)
            ->where('baseline_targets.deleted_at', '=', null)
            ->groupBy('users.id')
            ->groupBy('pembelians.created_by_id')
            ->groupBy('baseline_targets.nama_user_id')
            // ->where('users.id','=', Auth::id())
            ->groupBy('nama_plastik')
            ->groupBy('name')
            ->groupBy('baseline')
            ->groupBy('target')
            ->groupBy('insentif_kg')
            ->get();

        $berat = $query->groupBy(['name'])->map(function ($item) {
            $data = $item->groupBy('nama_plastik');
            return $data;
        });

        // return $berat;
        return view('admin.baselineTargets.laporan', compact('berat'));
    }

    private function mapPlastiks($plastiks)
    {
        return collect($plastiks)->map(function ($i) {
            return ['baseline' => $i];
        });
    }
    private function mapTarget($plastiks)
    {
        return collect($plastiks)->map(function ($i) {
            return ['target' => $i];
        });
    }


    public function massDestroy(MassDestroyBaselineTargetRequest $request)
    {
        BaselineTarget::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function dependendDropdown(Request $request)
    {
        $param = $request->input('user');
        $user = User::findOrfail($param);
        $plastik = $user->nama_plastiks;
        return response()->json($plastik);
    }
}
