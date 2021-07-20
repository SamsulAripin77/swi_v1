@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kategoriPlastik.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kategori-plastiks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="jenis_plastik">{{ trans('cruds.kategoriPlastik.fields.jenis_plastik') }}</label>
                <input class="form-control {{ $errors->has('jenis_plastik') ? 'is-invalid' : '' }}" type="text" name="jenis_plastik" id="jenis_plastik" value="{{ old('jenis_plastik', '') }}" required>
                @if($errors->has('jenis_plastik'))
                    <span class="text-danger">{{ $errors->first('jenis_plastik') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kategoriPlastik.fields.jenis_plastik_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.kategoriPlastik.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', '') }}">
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kategoriPlastik.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection