<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\pembelianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{JenisPlastik,Pembelian};

class ExportController extends Controller
{
    public function pembelianExport() {
        $pembelians = Pembelian::with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();
        $plastiks = JenisPlastik::where('nama_plastik', '!=', 'produk hasil olahan')->get();
        // return $plastiks;
        return view('admin.exports.export',compact('pembelians','plastiks'));
        // return Excel::download(new pembelianExport, 'pembelian.xlsx');
    }
}
