@extends('layouts.admin')
@section('content')
@include('partials.sumber-sampah-modal')
<div class="card">
    <div class="card-header">
        Edit data mitra
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-mitra.update",[$dataMitra->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_mitra">Nama Mitra</label>
                <input class="form-control {{ $errors->has('nama_mitra') ? 'is-invalid' : '' }}" type="text"
                    name="nama_mitra" id="nama_mitra" value="{{ old('nama_mitra', $dataMitra->nama_mitra) }}" required>
                @if($errors->has('nama_mitra'))
                <span class="text-danger">{{ $errors->first('nama_mitra') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="jenis_usaha_id">{{ trans('cruds.supplier.fields.jenis_usaha') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('jenis_usaha') ? 'is-invalid' : '' }}"
                    name="jenis_usaha_id[]" id="jenis_usaha_id" required multiple>
                    @foreach($jenis_usahas as $id => $jenis_usaha)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('jenis_plastiks', [])) || $dataMitra->jenis_usahas->contains($id)) ? 'selected' : '' }}>
                        {{ $jenis_usaha }}
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
                    id="alamat" value="{{ old('alamat', $dataMitra->alamat) }}" required>
                @if($errors->has('alamat'))
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_hp">No telp/WA</label>
                <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="number" name="no_hp"
                    id="no_hp" value="{{ old('no_hp', $dataMitra->no_hp) }}" required>
                @if($errors->has('no_hp'))
                <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                @endif
                <span class="help-block"></span>
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
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('jenis_plastiks', [])) || $dataMitra->jenis_plastiks->contains($id)) ? 'selected' : '' }}>
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
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('sumber_sampahs', [])) || $dataMitra->sumber_sampahs->contains($id)) ? 'selected' : '' }}>
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
                <label for="lokasi_sampah">Lokasi Sampah</label>
                <input class="form-control {{ $errors->has('lokasi_sampah') ? 'is-invalid' : '' }}" type="text"
                    name="lokasi_sampah" id="lokasi_sampah"
                    value="{{ old('lokasi_sampah', $dataMitra->lokasi_sampah) }}">
                @if($errors->has('lokasi_sampah'))
                <span class="text-danger">{{ $errors->first('lokasi_sampah') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            @can('admin-only')
            <div class="form-group">
                <label for="nama_user">Nama user</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama_user[]"
                    id="nama_user" multiple>
                    @foreach($nama_users as $id => $nama_user)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('nama_user', [])) || $dataMitra->nama_users->contains($id)) ? 'selected' : '' }}>
                        {{ $nama_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_user'))
                <span class="text-danger">{{ $errors->first('jenis_plastiks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.jenis_plastik_helper') }}</span>
            </div>
            @endcan
            @cannot('admin-only')
            <input type="hidden" name="nama_user[]" value={{Auth::id()}}>
            @endcannot
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection