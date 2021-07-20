@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-header">
    Buat Kemitraan
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route("admin.kemitraan.store") }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label class="required" for="tgl_beli">{{ trans('cruds.pembelian.fields.tgl_beli') }}</label>
        <input class="form-control date {{ $errors->has('tgl_beli') ? 'is-invalid' : '' }}" type="text" name="tgl_beli"
          id="tgl_beli" value="{{ old('tgl_beli') }}" placeholder="tanggal pembelian" required>
        @if($errors->has('tgl_beli'))
        <div class="invalid-feedback">
          {{ $errors->first('tgl_beli') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.tgl_beli_helper') }}</span>
      </div>
      <div class="form-group">
        <label class="required" for="nama_mitra">Nama Mitra</label>
        <select class="form-control select2 {{ $errors->has('nama_mitra') ? 'is-invalid' : '' }}" name="nama_mitra"
          id="nama_mitra" required>
          @foreach($nama_mitras as $nama_mitra)
          <option value="{{ $nama_mitra->id }}" {{ old('nama_mitra') ==  $nama_mitra->id ? 'selected' : '' }}>
            {{ $nama_mitra->nama_mitra }}
          </option>
          @endforeach
        </select>
        @if($errors->has('nama_mitra_user'))
        <span class="text-danger">{{ $errors->first('nama_mitra_user') }}</span>
        @endif
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="jenis_plastiks">{{ trans('cruds.supplier.fields.jenis_plastik') }}</label>
        <div style="padding-bottom: 4px">
          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
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
        <label class="required" for="total_berat">{{ trans('cruds.pembelian.fields.total_berat') }}</label>
        <input class="total-berat form-control {{ $errors->has('total_berat') ? 'is-invalid' : '' }}" type="number"
          name="total_berat" id="total_berat" value="{{ old('total_berat', '') }}"
          placeholder="klik untuk mendapatkan total berat" required>
        @if($errors->has('total_berat'))
        <div class="invalid-feedback">
          {{ $errors->first('total_berat') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.berat_helper') }}</span>
      </div>
      <div class="form-group">
        <label for="photo">{{ trans('cruds.pembelian.fields.photo') }}</label>
        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
        </div>
        @if($errors->has('photo'))
        <div class="invalid-feedback">
          {{ $errors->first('photo') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.photo_helper') }}</span>
      </div>
      <div class="form-group">
        <label for="video">{{ trans('cruds.pembelian.fields.video') }}</label>
        <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
        </div>
        @if($errors->has('video'))
        <div class="invalid-feedback">
          {{ $errors->first('video') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.video_helper') }}</span>
      </div>
      @can('admin-only')
      <div class="form-group">
        <label class="required" for="nama">{{ trans('cruds.baselineTarget.fields.nama_user') }}</label>
        <div style="padding-bottom: 4px">
          <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
          <span class="btn btn-info btn-xs deselect-all"
            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
        </div>
        <select class="form-control select2 {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama[]" id="nama"
          required multiple>
          @foreach($nama_users as $nama_user)
          <option value="{{ $nama_user->id }}" {{ old('nama') ==  $nama_user->id ? 'selected' : '' }}>
            {{ $nama_user->name }}
          </option>
          @endforeach
        </select>
        @if($errors->has('nama_user'))
        <span class="text-danger">{{ $errors->first('nama_user') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.baselineTarget.fields.nama_user_helper') }}</span>
      </div>
      @endcan
      @cannot('admin-only')
      <input type="hidden" name="nama[]" value={{Auth::id()}}>
      @endcannot
      <div class="form-group">
        <div class="form-check {{ $errors->has('menyetujui') ? 'is-invalid' : '' }}">
          <input class="form-check-input" type="checkbox" name="menyetujui" id="menyetujui" value="1"
            {{ old('menyetujui', 0) == 1 ? 'checked' : '' }} required>
          <label class="required form-check-label" for="menyetujui">Menyetujui</label>
        </div>
        @if($errors->has('menyetujui'))
        <div class="invalid-feedback">
          {{ $errors->first('menyetujui') }}
        </div>
        @endif
        <span class="help-block"></span>
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

@section('scripts')
<script>
  var uploadedPhotoMap = {}
  Dropzone.options.photoDropzone = {
    url: '{{ route('admin.kemitraan.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input  type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if (isset($pembelian) && $pembelian -> photo)
        var files = {!! json_encode($pembelian -> photo)!!
    }
          for(var i in files) {
    var file = files[i]
    this.options.addedfile.call(this, file)
    this.options.thumbnail.call(this, file, file.preview)
    file.previewElement.classList.add('dz-complete')
    $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
  }
  @endif
    },
  error: function (file, response) {
    if ($.type(response) === 'string') {
      var message = response //dropzone sends it's own error messages in string
    } else {
      var message = response.errors.file
    }
    file.previewElement.classList.add('dz-error')
    _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
    _results = []
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      node = _ref[_i]
      _results.push(node.textContent = message)
    }

    return _results
  }
}
</script>
<script>
  Dropzone.options.videoDropzone = {
    url: '{{ route('admin.kemitraan.storeMedia') }}',
    maxFilesize: 20, // MB
    maxFiles: 1,
    acceptedFiles: '.mp4,.webm,.mkv,.avi,.3gp',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20, //mb
      format: 'video'
    },
    success: function (file, response) {
      $('form').find('input[name="video"]').remove()
      $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
      @if (isset($pembelian) && $pembelian -> video)
        var file = {!! json_encode($pembelian -> video)!!
    }
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
  error: function (file, response) {
    if ($.type(response) === 'string') {
      var message = response //dropzone sends it's own error messages in string
    } else {
      var message = response.errors.file
    }
    file.previewElement.classList.add('dz-error')
    _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
    _results = []
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      node = _ref[_i]
      _results.push(node.textContent = message)
    }

    return _results
  }
}
</script>

@endsection