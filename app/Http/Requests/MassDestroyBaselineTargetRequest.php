<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BaselineTarget;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBaselineTargetRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('baseline_target_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:baseline_targets,id',
]
    
}

}