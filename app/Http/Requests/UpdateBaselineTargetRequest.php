<?php

namespace App\Http\Requests;

use App\Models\BaselineTarget;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBaselineTargetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('baseline_target_edit');
    }

    public function rules()
    {
        return [
            'nama_plastiks.*' => [
                'nullable',
            ],
            'nama_plastiks' => [
                'required',
                'array',
            ],
            
            'baseline.*' => [
                'required',
            ],
            'target.*' => [
                'required',
            ],
            'insentif.*' => [
                'required',
            ]
        ];
    }
}
