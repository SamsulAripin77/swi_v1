@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jenisUsaha.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-usahas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.id') }}
                        </th>
                        <td>
                            {{ $jenisUsaha->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.nama_usaha') }}
                        </th>
                        <td>
                            {{ $jenisUsaha->nama_usaha }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $jenisUsaha->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-usahas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection