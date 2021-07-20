<?php

namespace App\Http\Requests;

use App\Models\KategoriPlastik;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKategoriPlastikRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kategori_plastik_create');
    }

    public function rules()
    {
        return [
            'jenis_plastik' => [
                'string',
                'required',
            ],
            'keterangan' => [
                'string',
                'nullable',
            ],
        ];
    }
}
