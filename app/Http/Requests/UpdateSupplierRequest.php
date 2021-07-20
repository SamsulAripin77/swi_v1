<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('supplier_edit');
    }

    public function rules()
    {
        return [
            'nama_supplier' => [
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
                'required',
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
