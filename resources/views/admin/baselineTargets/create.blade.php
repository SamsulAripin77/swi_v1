@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.baselineTarget.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.baseline-targets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_user_id">{{ trans('cruds.baselineTarget.fields.nama_user') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_user') ? 'is-invalid' : '' }}"
                    name="nama_user_id" id="nama_user_id" required>
                    @foreach($nama_users as $nama_user)
                    <option value="{{ $nama_user->id }}" {{ old('nama_user_id') ==  $nama_user ? 'selected' : '' }}>
                        {{ $nama_user->name }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('nama_user'))
                <span class="text-danger">{{ $errors->first('nama_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.baselineTarget.fields.nama_user_helper') }}</span>
            </div>
            @include('partials.baseline_jenis_plastik')
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')

@endsection