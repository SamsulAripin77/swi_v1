<?php

namespace App\Http\Requests;

use App\Models\SumberSampah;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSumberSampahRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sumber_sampah_edit');
    }

    public function rules()
    {
        return [
            'sumber_sampah' => [
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
