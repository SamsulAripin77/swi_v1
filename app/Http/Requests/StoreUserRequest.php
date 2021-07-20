<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'required',
                'unique:users,username',
            ], 'email' => [
                'email',
                'string',
                'required',
                'unique:users,email',
            ],
            'password' => [
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'jenis_usaha_id.*' => [
                'integer',
            ],
            'nama_usaha_id' => [
                'required',
                'array',
            ],
            'jenis_plastiks.*' => [
                'integer',
            ],
            'jenis_plastiks' => [
                'required',
                'array',
            ],
            'alamat' => [
                'string',
                'required',
            ],
            'no_tlp' => [
                'string',
                'max:13',
                'required',
                'unique:users,no_tlp'
            ],
            'keterangan' => [
                'string',
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
