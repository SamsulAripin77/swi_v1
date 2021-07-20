<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\JenisUsaha;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJenisUsahaRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('jenis_usaha_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:jenis_usahas,id',
]
    
}

}