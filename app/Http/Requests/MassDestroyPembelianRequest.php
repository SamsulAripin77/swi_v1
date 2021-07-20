<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pembelian;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPembelianRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('pembelian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:pembelians,id',
]
    
}

}