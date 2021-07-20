<?php

namespace App\Http\Requests;

use App\Models\JenisPlastik;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJenisPlastikRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenis_plastik_create');
    }

    public function rules()
    {
        return [
            'kategori_plastik_id' => [
                'required',
                'integer',
            ],
            'nama_plastik' => [
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
