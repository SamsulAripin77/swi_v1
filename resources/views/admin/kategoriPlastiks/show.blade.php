@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kategoriPlastik.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kategori-plastiks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kategoriPlastik.fields.id') }}
                        </th>
                        <td>
                            {{ $kategoriPlastik->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kategoriPlastik.fields.jenis_plastik') }}
                        </th>
                        <td>
                            {{ $kategoriPlastik->jenis_plastik }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kategoriPlastik.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $kategoriPlastik->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kategori-plastiks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection