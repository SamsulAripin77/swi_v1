<?php

namespace App\Http\Requests;

use App\Models\BaselineTarget;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBaselineTargetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('baseline_target_create');
    }

    public function rules()
    {
        return [
            'nama_plastiks.*' => [
                'integer',
            ],
            'nama_plastiks' => [
                'required',
                'array',
            ],
            'nama_user_id' => [
                'required',
                'unique:baseline_targets,nama_user_id'
            ],
            'baseline' => [
                'array',
            ],
            'baseline.*' => [
                'required',
            ],
            'target' => [
                'array'
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
