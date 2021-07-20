<?php

namespace App\Http\Requests;

use App\Models\JenisUsaha;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJenisUsahaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenis_usaha_edit');
    }

    public function rules()
    {
        return [
            'nama_usaha' => [
                'string',
                'required',
            ],
            'keterangan' => [
                'string',
                'nullable',
            ],
            'kode' => [
                'string',
                'required'
            ]
        ];
    }
}
