@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.baselineTarget.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.baseline-targets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.id') }}
                        </th>
                        <td>
                            {{ $baselineTarget->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.nama_user') }}
                        </th>
                        <td>
                            {{ $baselineTarget->nama_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.jenis_plastik') }}
                        </th>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th>jenis</th>
                                        <th>baseline</th>
                                        <th>target</th>
                                        <th>insentif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($baselineTarget->nama_plastiks as $key => $jenis_plastik)
                                    <tr>
                                        <td>{{$jenis_plastik->nama_plastik}}</td>
                                        <td>{{$jenis_plastik->pivot->baseline}}</td>
                                        <td>{{$jenis_plastik->pivot->target}}</td>
                                        <td>{{$jenis_plastik->pivot->insentif}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.baseline-targets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection