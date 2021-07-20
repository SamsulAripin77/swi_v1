@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jenisPlastik.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jenis-plastiks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kategori_plastik_id">{{ trans('cruds.jenisPlastik.fields.kategori_plastik') }}</label>
                <select class="form-control select2 {{ $errors->has('kategori_plastik') ? 'is-invalid' : '' }}" name="kategori_plastik_id" id="kategori_plastik_id" required>
                    @foreach($kategori_plastiks as $id => $kategori_plastik)
                        <option value="{{ $id }}" {{ old('kategori_plastik_id') == $id ? 'selected' : '' }}>{{ $kategori_plastik }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori_plastik'))
                    <span class="text-danger">{{ $errors->first('kategori_plastik') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisPlastik.fields.kategori_plastik_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_plastik">{{ trans('cruds.jenisPlastik.fields.nama_plastik') }}</label>
                <input class="form-control {{ $errors->has('nama_plastik') ? 'is-invalid' : '' }}" type="text" name="nama_plastik" id="nama_plastik" value="{{ old('nama_plastik', '') }}" required>
                @if($errors->has('nama_plastik'))
                    <span class="text-danger">{{ $errors->first('nama_plastik') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisPlastik.fields.nama_plastik_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.jenisPlastik.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', '') }}">
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jenisPlastik.fields.keterangan_helper') }}</span>
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