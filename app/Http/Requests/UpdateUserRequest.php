<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'required',
                'unique:users,username,' . request()->route('user')->id,
            ],
            'email' => [
                'email',
                'string',
                'required',
                "unique:users,email,{$this->user->id}",
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
                "unique:users,email,{$this->user->no_tlp}",
            ],
            'koordinat' => [
                'string',
                'nullable',
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
