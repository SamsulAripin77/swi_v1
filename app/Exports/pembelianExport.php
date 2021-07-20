<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\{JenisPlastik,Pembelian};


class pembelianExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $pembelians = Pembelian::with(['nama_supplier', 'nama_plastiks', 'media'])->orderBy('tgl_beli')->get();
        $plastiks = JenisPlastik::where('nama_plastik', '!=', 'produk hasil olahan')->get();
        return view('admin.exports.export', [
            'pembelians' => $pembelians,
            'plastiks' => $plastiks
        ]);
    }
}
