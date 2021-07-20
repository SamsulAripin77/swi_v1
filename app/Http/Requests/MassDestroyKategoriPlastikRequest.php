<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\KategoriPlastik;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKategoriPlastikRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('kategori_plastik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:kategori_plastiks,id',
]
    
}

}