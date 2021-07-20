@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sumberSampah.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sumber-sampahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sumberSampah.fields.id') }}
                        </th>
                        <td>
                            {{ $sumberSampah->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sumberSampah.fields.sumber_sampah') }}
                        </th>
                        <td>
                            {{ $sumberSampah->sumber_sampah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sumberSampah.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $sumberSampah->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sumber-sampahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection