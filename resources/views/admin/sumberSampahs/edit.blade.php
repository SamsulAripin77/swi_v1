@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sumberSampah.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sumber-sampahs.update", [$sumberSampah->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sumber_sampah">{{ trans('cruds.sumberSampah.fields.sumber_sampah') }}</label>
                <input class="form-control {{ $errors->has('sumber_sampah') ? 'is-invalid' : '' }}" type="text" name="sumber_sampah" id="sumber_sampah" value="{{ old('sumber_sampah', $sumberSampah->sumber_sampah) }}" required>
                @if($errors->has('sumber_sampah'))
                    <span class="text-danger">{{ $errors->first('sumber_sampah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sumberSampah.fields.sumber_sampah_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.sumberSampah.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', $sumberSampah->keterangan) }}">
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sumberSampah.fields.keterangan_helper') }}</span>
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