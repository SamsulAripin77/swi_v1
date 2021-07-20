@extends('layouts.admin')
@section('styles')
{{-- @include('partials.cssCreateEdit') --}}
@endsection
@section('content')

<div class="card">
  <div class="card-header">
    {{ trans('global.create') }} {{ trans('cruds.pembelian.title_singular') }}
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route("admin.pembelians.store") }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label class="required" for="tgl_beli">{{ trans('cruds.pembelian.fields.tgl_beli') }}</label>
        <input class="form-control date {{ $errors->has('tgl_beli') ? 'is-invalid' : '' }}" type="text" name="tgl_beli"
          id="tgl_beli" value="{{ old('tgl_beli') }}" placeholder="tanggal pembelian format: tgl/bln/thn" required>
        @if($errors->has('tgl_beli'))
        <div class="invalid-feedback">
          {{ $errors->first('tgl_beli') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.tgl_beli_helper') }}</span>
      </div>
      <div class="form-group">
        <label class="required" for="nama_supplier_id">{{ trans('cruds.pembelian.fields.nama_supplier') }}</label>
        <select class="form-control {{ $errors->has('nama_supplier_id') ? 'is-invalid' : '' }}" name="nama_supplier_id"
          id="nama_supplier_id" required>
          @foreach($nama_suppliers as $id => $nama_supplier)
          <option value="{{ $id }}" {{ old('nama_supplier_id') == $id ? 'selected' : '' }}>
            {{ $nama_supplier }}</option>
          @endforeach
        </select>
        @if($errors->has('nama_supplier_id'))
        <div class="invalid-feedback">
          {{ $errors->first('nama_supplier_id') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.nama_supplier_helper') }}</span>
      </div>

      @include('partials.jenis_plastik_create')

      <div class="form-group">
        <label class="required" for="total_berat">{{ trans('cruds.pembelian.fields.total_berat') }}</label>
        <input class="total-berat form-control {{ $errors->has('total_berat') ? 'is-invalid' : '' }}" type="number"
          step=".1" name="total_berat" id="total_berat" value="{{ old('total_berat', '') }}"
          placeholder="klik untuk mendapatkan total berat" required disabled>
        @if($errors->has('total_berat'))
        <div class="invalid-feedback">
          {{ $errors->first('total_berat') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.berat_helper') }}</span>
      </div>
      @if (Auth::user()->isTrilion())
      <div class="form-group">
        <label class="required" for="status_plastik">Status Plastik</label>
        <select class="form-control {{ $errors->has('status_plastik') ? 'is-invalid' : '' }}" name="status_plastik"
          id="status_plastik" required>
          <option value="New supplier" {{ old('status_plastik') == 'New supplier' ? 'selected' : '' }}>
            New Supplier</option>
          <option value="White space" {{ old('status_plastik') == 'White space' ? 'selected' : '' }}>
            White space</option>
        </select>
        @if($errors->has('status_plastik'))
        <div class="invalid-feedback">
          {{ $errors->first('status_plastik') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.nama_supplier_helper') }}</span>
      </div>
      @endif
      <div class="form-group">
        <label class="required" for="photo_manifes">{{ trans('cruds.pembelian.fields.photo_manifes') }}</label>
        <div class="needsclick dropzone {{ $errors->has('photo_manifes') ? 'is-invalid' : '' }}"
          id="photo_manifes-dropzone">
        </div>
        @if($errors->has('photo_manifes'))
        <div class="invalid-feedback">
          {{ $errors->first('photo_manifes') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.photo_manifes_helper') }}</span>
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
      <div class="form-group">
        <div class="form-check {{ $errors->has('konfirmasi') ? 'is-invalid' : '' }}">
          <input class="form-check-input" type="checkbox" name="konfirmasi" id="konfirmasi" value="1"
            {{ old('konfirmasi', 0) == 1 ? 'checked' : '' }} required>
          <label class="required form-check-label"
            for="konfirmasi">{{ trans('cruds.pembelian.fields.konfirmasi') }}</label>
        </div>
        @if($errors->has('konfirmasi'))
        <div class="invalid-feedback">
          {{ $errors->first('konfirmasi') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.pembelian.fields.konfirmasi_helper') }}</span>
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
{{-- @parent --}}
{{-- @include('partials.jsCreateEdit') --}}
<script>
  Dropzone.options.photoManifesDropzone = {
    url: '{{ route('admin.pembelians.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input  type="hidden" name="photo_manifes[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo_manifes"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
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
      $('form').find('input[name="photo_manifes[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if (isset($pembelian) && $pembelian -> photo_manifes)
        var file = {!! json_encode($pembelian -> photo_manifes)!!
    }
    for(var i in files) {
      this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo_manifes[]" value="' + file.file_name + '">')
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
  var uploadedPhotoMap = {}
  Dropzone.options.photoDropzone = {
    url: '{{ route('admin.pembelians.storeMedia') }}',
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
    url: '{{ route('admin.pembelians.storeMedia') }}',
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