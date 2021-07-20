<?php
  
namespace App\Imports;

use App\Models\Pembelian;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;
use Throwable;

class PembelianImport implements ToCollection,
WithHeadingRow,
SkipsOnError,
WithValidation,
SkipsOnFailure,
WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $pembelianId = null;
        foreach ($rows as $row){
            $pembelianId = Pembelian::create([
                'tgl_beli' => $row['tgl_beli'],
                'nama_supplier_id' => $row['nama_supplier_id'],
                'total_berat' => $row['total_berat'],
                'konfirmasi' => $row['konfirmasi'],
                'status_plastik' => $row['status_plastik'],
                'created_by_id' => $row['created_by_id']
            ]);     
            $plastiks = explode(',',$row['jenis_plastik']);  
            $berats  = explode(',',$row['berat_plastik']);
            foreach ($plastiks as $key => $plastik){
                error_log($plastik);
                $pembelianId->nama_plastiks()->attach($plastik, array('berat' => $berats[$key]));
            }
        }
        return $pembelianId;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules() : array {
        return [
            'tgl_beli'        => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status_plastik' =>['nullable', Rule::in(['New supplier','White space'])],
            'total_berat'     => [
                'nullable',
                'numeric',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nama_supplier_id' => 'nullable',
            'konfirmasi' => 'nullable',
        ];
    }

    private function mapPlastiks($plastiks)
    {
        return collect($plastiks)->map(function ($i) {
            return ['berat' => $i];
        });
    }
}
