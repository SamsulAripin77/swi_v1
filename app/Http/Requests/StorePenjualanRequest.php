<?php

namespace App\Http\Requests;

use App\Models\Penjualan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePenjualanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('penjualan_create');
    }

    public function rules()
    {
        return [
            'nama_buyer_id' => 'required',
            'tgl_jual'        => [
                'date_format:' . config('panel.date_format'),
                'nullable',
                'required',
            ],
            'nama_plastiks.*' => [
                'numeric',
            ],
            'nama_plastiks'   => [
                'array',
            ],
            'deskripsi' => [
                'nullable'
            ],
            'total_berat'           => [
                'nullable',
                'numeric',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],

            'nama_plastiks' => 'required',
            'konfirmasi' => 'required',
            'photo_manifes' => 'required',
            'foto' => 'image',
        ];
    }
}
