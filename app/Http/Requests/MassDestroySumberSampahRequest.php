<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SumberSampah;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySumberSampahRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('sumber_sampah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:sumber_sampahs,id',
]
    
}

}