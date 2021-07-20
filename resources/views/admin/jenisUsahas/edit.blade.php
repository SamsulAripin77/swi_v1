@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jenisUsaha.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jenis-usahas.update", [$jenisUsaha->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_usaha">{{ trans('cruds.jenisUsaha.fields.nama_usaha') }}</label>
                <input class="form-control {{ $errors->has('nama_usaha') ? 'is-invalid' : '' }}" type="text"
                    name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha', $jenisUsaha->nama_usaha) }}" required>
                @if($errors->has('nama_usaha'))
                <span class="text-danger">{{ $errors->first('nama_usaha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisUsaha.fields.nama_usaha_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kode">{{ trans('cruds.jenisUsaha.fields.kode') }}</label>
                <input class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}" type="text" name="kode"
                    id="kode" value="{{ old('kode', '') }}" required>
                @if($errors->has('kode'))
                <span class="text-danger">{{ $errors->first('kode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisUsaha.fields.kode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.jenisUsaha.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text"
                    name="keterangan" id="keterangan" value="{{ old('keterangan', $jenisUsaha->keterangan) }}">
                @if($errors->has('keterangan'))
                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisUsaha.fields.keterangan_helper') }}</span>
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