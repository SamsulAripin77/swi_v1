<?php

namespace App\Http\Requests;

use App\Models\Buyer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBuyerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('buyer_create');
    }

    public function rules()
    {
        return [
            'nama_buyer' => [
                'string',
                'required',
            ],
            'jenis_usaha_id' => [
                'required',
                'integer',
            ],
            'alamat' => [
                'string',
                'required',
            ],
            'no_telp' => [
                'string',
                'required',
            ],
            'jenis_plastiks.*' => [
                'integer',
            ],
            'jenis_plastiks' => [
                'array',
            ],
            'sumber_sampahs.*' => [
                'integer',
            ],
            'sumber_sampahs' => [
                'array',
            ],
            'lokasi_sumber_sampah' => [
                'string',
                'nullable',
            ],
            'id_users.*' => [
                'integer',
            ],
            'id_users' => [
                'array',
            ],
        ];
    }
}
