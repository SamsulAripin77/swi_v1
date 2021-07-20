<?php

namespace App\Http\Controllers\Admin;

use App\Models\{User,Buyer, Supplier, Kemitraan};
use Gate;
use Illuminate\Support\Facades\{DB, Auth};
use Illuminate\Database\Eloquent\Builder;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Total Incremental',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Pembelian',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'berat',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
            'translation_key'       => 'pembelian',
        ];

        $authorize = Gate::inspect('admin-only');
        $authUserMonitor = Gate::inspect('user-monitor');

        $dasboard = [
            'total_tonase_beli' => $this->beratKategori('pembelians', 'jenis_plastik_pembelian', '.pembelian_id'),
            // 'total_tonase_jual' => $this->beratKategori('penjualans', 'jenis_plastik_penjualan', '.penjualan_id'),
            'jumlah_buyer' => Auth::user()->buyers->count(),
            'jumlah_supplier' => Auth::user()->supplier->count(),
            'jumlah_plastik' => Auth::user()->jenis_plastiks->count(),
            'jumlah_pembelian' => Auth::user()->pembelians->sum('total_berat'),
            'grafik' => $this->userGrafik(),
            'grafik_mitra' => $this->grafikMitra()

        ];
        if ($authorize->allowed() || $authUserMonitor->allowed()) {
            $dasboard = [

                'user_count' =>  User::with(['roles'])->whereHas('roles', function (Builder $query) {
                    $query->where('title', '=', 'User');
                })->count(),
                'buyer_count' => Buyer::count(),
                'supplier_count' => Supplier::count(),
                'users_beli' => $this->beratCollection('pembelians'),
                'users_jual' => $this->beratCollection('penjualans'),
                'grafik_admin' => $this->grafikAdmin(),
                'grafik_mitra' => $this->grafikMitra()
            ];
        }

        return view('home', compact('dasboard'));
    }

    private function beratCollection($table)
    {
        $query = DB::table($table)
            ->join('users', 'users.id', '=', $table . '.created_by_id')
            ->select($table . '.total_berat', 'users.id', 'users.name')
            ->where($table . '.deleted_at', '=', null)
            ->get();
        $berat = $query->groupBy('name')->map(function ($item) {
            return $item->sum('total_berat');
        });
        return $berat;
    }

    private function beratKategori($table, $pivot, $pivot_id)
    {
        $query = DB::table('jenis_plastiks')
            ->select('jenis_plastiks.id', 'jenis_plastiks.nama_plastik', $pivot . '.berat')
            ->join($pivot, $pivot . '.jenis_plastik_id', '=', 'jenis_plastiks.id')
            ->join($table, $table . '.id', '=', $pivot . $pivot_id)
            ->where($table . '.deleted_at', '=', null)
            ->where($table . '.created_by_id', '=', Auth::id())
            ->get();
        $berat = $query->groupBy('nama_plastik')->map(function ($item) {
            return $item->sum('berat');
        });
        return $berat;
    }

    private function userGrafik() {
        $query  = DB::table('jenis_plastiks')
        ->selectRaw('
                    nama_plastik,
                    users.name as name,
                    baseline_target_jenis_plastik.baseline,
                    baseline_target_jenis_plastik.baseline + baseline_target_jenis_plastik.target  as target,
                    baseline_target_jenis_plastik.insentif as insentif_kg,
                    SUM(jenis_plastik_pembelian.berat) as pengumpulan,
                    SUM(jenis_plastik_pembelian.berat) - baseline as incremental,
                    (SUM(jenis_plastik_pembelian.berat) - baseline) * baseline_target_jenis_plastik.insentif as insentif,

                    users.id as user_id,
                    pembelians.created_by_id as pembelian_user,
                    baseline_targets.nama_user_id as baseline_user
                    '
                    )
        ->join('jenis_plastik_pembelian',  'jenis_plastik_pembelian.jenis_plastik_id', '=', 'jenis_plastiks.id')
        ->join('pembelians', 'pembelians.id', '=', 'jenis_plastik_pembelian.pembelian_id')
        ->join('baseline_target_jenis_plastik', 'baseline_target_jenis_plastik.jenis_plastik_id', '=', 'jenis_plastiks.id')
        ->join('baseline_targets',function($join){
            $join->on('baseline_targets.id','=', 'baseline_target_jenis_plastik.baseline_target_id');
            $join->on('baseline_targets.nama_user_id','=','pembelians.created_by_id');
        })
        ->join('users', 'baseline_targets.nama_user_id', '=', 'users.id')

        ->where('pembelians.deleted_at', '=', null)
        ->where('baseline_targets.deleted_at', '=', null)
        ->groupBy('users.id')
        ->groupBy('pembelians.created_by_id')
        ->groupBy('baseline_targets.nama_user_id')
        ->where('users.id','=', Auth::id())
        ->groupBy('nama_plastik')
        ->groupBy('name')
        ->groupBy('baseline')
        ->groupBy('target')
        ->groupBy('insentif_kg')
        ->get();

        return $query;
    }

    public function grafikMitra(){
        $grafikMitra = Kemitraan::all();
        $grafikMitra->load('nama_mitras');
        return $grafikMitra;
    }
    
   private function grafikAdmin (){
    $query  = DB::table('jenis_plastiks')
            ->selectRaw('
                        nama_plastik,
                        users.name as name,
                        CONVERT(baseline_target_jenis_plastik.baseline,int) as baseline,
                        baseline_target_jenis_plastik.baseline + baseline_target_jenis_plastik.target  as target,
                        baseline_target_jenis_plastik.insentif as insentif_kg,
                        SUM(jenis_plastik_pembelian.berat) as pengumpulan,
                        SUM(jenis_plastik_pembelian.berat) - baseline as incremental,
                        (SUM(jenis_plastik_pembelian.berat) - baseline) * baseline_target_jenis_plastik.insentif as insentif,
                        users.id as user_id,
                        pembelians.created_by_id as pembelian_user,
                        baseline_targets.nama_user_id as baseline_user
                        '
                        )
            ->join('jenis_plastik_pembelian',  'jenis_plastik_pembelian.jenis_plastik_id', '=', 'jenis_plastiks.id')
            ->join('pembelians', 'pembelians.id', '=', 'jenis_plastik_pembelian.pembelian_id')
            ->join('baseline_target_jenis_plastik', 'baseline_target_jenis_plastik.jenis_plastik_id', '=', 'jenis_plastiks.id')
            ->join('baseline_targets',function($join){
                $join->on('baseline_targets.id','=', 'baseline_target_jenis_plastik.baseline_target_id');
                $join->on('baseline_targets.nama_user_id','=','pembelians.created_by_id');
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
            // $berat = [];
          
            $berat = $query->groupBy(['name'])->map(function ($item) {
                $nama_plastik = array();
                $pengumpulan = array();
                $baseline = array();
                $target = array();
                $plastik = json_decode('{"plastik": [], "baseline":[], "target":[], "pengumpulan":[]}');
                foreach ($item as $key => $p){
                    array_push($nama_plastik, $p->nama_plastik);
                    array_push($baseline, $p->baseline);
                    array_push($target, $p->target);
                    array_push($pengumpulan, $p->pengumpulan);
                }
                $plastik->plastik = $nama_plastik;
                $plastik->baseline = $baseline;
                $plastik->target = $target;
                $plastik->pengumpulan = $pengumpulan;
                return $plastik;  
            });

            return $berat;
    }

}
