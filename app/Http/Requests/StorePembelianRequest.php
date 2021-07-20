<?php

namespace App\Http\Requests;

use App\Models\Pembelian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StorePembelianRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pembelian_create');
    }

    public function rules()
    {
        return [
            'tgl_beli'        => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'nama_plastiks.*' => [
                'numeric',
            ],
            'nama_plastiks'   => [
                'array',
            ],
            'status_plastik' =>['nullable', Rule::in(['New supplier','White space'])],
            'total_berat'     => [
                'nullable',
                'numeric',
                'min:-2147483648',
                'max:2147483647',
                'required'
            ],
            'nama_supplier_id' => 'required',
            'nama_plastiks' => 'required',
            'konfirmasi' => 'required',
            'tgl_beli' => 'required',
        ];
    }
}
