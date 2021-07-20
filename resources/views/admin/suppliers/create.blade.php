@extends('layouts.admin')
@section('content')
@include('partials.sumber-sampah-modal')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.supplier.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suppliers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_supplier">{{ trans('cruds.supplier.fields.nama_supplier') }}</label>
                <input class="form-control {{ $errors->has('nama_supplier') ? 'is-invalid' : '' }}" type="text"
                    name="nama_supplier" id="nama_supplier" value="{{ old('nama_supplier', '') }}" required>
                @if($errors->has('nama_supplier'))
                <span class="text-danger">{{ $errors->first('nama_supplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.nama_supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jenis_usaha_id">{{ trans('cruds.supplier.fields.jenis_usaha') }}</label>
                <select class="form-control select2 {{ $errors->has('jenis_usaha') ? 'is-invalid' : '' }}"
                    name="jenis_usaha_id" id="jenis_usaha_id" required>
                    @foreach($jenis_usahas as $id => $jenis_usaha)
                    <option value="{{ $id }}" {{ old('jenis_usaha_id') == $id ? 'selected' : '' }}>{{ $jenis_usaha }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('jenis_usaha'))
                <span class="text-danger">{{ $errors->first('jenis_usaha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.jenis_usaha_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alamat">{{ trans('cruds.supplier.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat"
                    id="alamat" value="{{ old('alamat', '') }}" required>
                @if($errors->has('alamat'))
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_telp">{{ trans('cruds.supplier.fields.no_telp') }}</label>
                <input class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}" type="text" name="no_telp"
                    id="no_telp" value="{{ old('no_telp', '') }}" required>
                @if($errors->has('no_telp'))
                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.no_telp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jenis_plastiks">{{ trans('cruds.supplier.fields.jenis_plastik') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('jenis_plastiks') ? 'is-invalid' : '' }}"
                    name="jenis_plastiks[]" id="jenis_plastiks" multiple>
                    @foreach($jenis_plastiks as $id => $jenis_plastik)
                    <option value="{{ $id }}" {{ in_array($id, old('jenis_plastiks', [])) ? 'selected' : '' }}>
                        {{ $jenis_plastik }}</option>
                    @endforeach

                </select>
                @if($errors->has('jenis_plastiks'))
                <span class="text-danger">{{ $errors->first('jenis_plastiks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.jenis_plastik_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sumber_sampahs">{{ trans('cruds.supplier.fields.sumber_sampah') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sumber_sampahs') ? 'is-invalid' : '' }}"
                    name="sumber_sampahs[]" id="sumber_sampahs" multiple required>
                    @foreach($sumber_sampahs as $id => $sumber_sampah)
                    <option value="{{ $id }}" {{ in_array($id, old('sumber_sampahs', [])) ? 'selected' : '' }}>
                        {{ $sumber_sampah }}</option>
                    @endforeach
                    <option value="lainnya">Lainnya Sebutkan</option>
                </select>
                @if($errors->has('sumber_sampahs'))
                <span class="text-danger">{{ $errors->first('sumber_sampahs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.sumber_sampah_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lokasi_sumber_sampah">{{ trans('cruds.supplier.fields.lokasi_sumber_sampah') }}</label>
                <input class="form-control {{ $errors->has('lokasi_sumber_sampah') ? 'is-invalid' : '' }}" type="text"
                    name="lokasi_sumber_sampah" id="lokasi_sumber_sampah" value="{{ old('lokasi_sumber_sampah', '') }}">
                @if($errors->has('lokasi_sumber_sampah'))
                <span class="text-danger">{{ $errors->first('lokasi_sumber_sampah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.lokasi_sumber_sampah_helper') }}</span>
            </div>
            @can('admin-only')
            <div class="form-group">
                <label for="id_users">{{ trans('cruds.supplier.fields.id_user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('id_users') ? 'is-invalid' : '' }}"
                    name="id_users[]" id="id_users" multiple>
                    @foreach($id_users as $id => $id_user)
                    <option value="{{ $id }}" {{ in_array($id, old('id_users', [])) ? 'selected' : '' }}>{{ $id_user }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('id_users'))
                <span class="text-danger">{{ $errors->first('id_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.id_user_helper') }}</span>
            </div>
            @endcan
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection