@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.baselineTarget.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.baseline-targets.update", [$baselineTarget->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nama_user_id">{{ trans('cruds.baselineTarget.fields.nama_user') }}</label>
                <input type="hidden" name="nama_user_id" id="nama_user_id" value="{{$baselineTarget->nama_user_id}}">

                <input type="text" class="form-control" value="{{$baselineTarget->nama_user->name}}" disabled>
                @if($errors->has('nama_user'))
                <span class="text-danger">{{ $errors->first('nama_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.baselineTarget.fields.nama_user_helper') }}</span>
            </div>
            @include('partials.edit_baseline')
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection