@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.penjualan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.penjualans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tgl_jual">{{ trans('cruds.penjualan.fields.tgl_jual') }}</label>
                <input class="form-control date {{ $errors->has('tgl_jual') ? 'is-invalid' : '' }}" type="text"
                    name="tgl_jual" id="tgl_jual" value="{{ old('tgl_jual') }}"
                    placeholder="tanggal penjualan format: tgl/bln/thn" required>
                @if($errors->has('tgl_jual'))
                <div class="invalid-feedback">
                    {{ $errors->first('tgl_jual') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.tgl_jual_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_buyer_id">{{ trans('cruds.penjualan.fields.nama_buyer') }}</label>
                <select class="form-control {{ $errors->has('nama_buyer') ? 'is-invalid' : '' }}" name="nama_buyer_id"
                    id="nama_buyer_id" required>
                    @foreach($nama_buyers as $id => $nama_buyer)
                    <option value="{{ $id }}" {{ old('nama_buyer_id') == $id ? 'selected' : '' }}>{{ $nama_buyer }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('nama_buyer_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('nama_buyer_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.nama_buyer_helper') }}</span>
            </div>

            @include('partials.jenis_plastik_create')

            <div class="form-group mt-3">
                <label class="required" for="total_berat">{{ trans('cruds.penjualan.fields.total_berat') }}</label>
                <input class="form-control total-berat {{ $errors->has('total_berat') ? 'is-invalid' : '' }}"
                    type="number" name="total_berat" id="total_berat" value="{{ old('total_berat', '') }}" step=".1"
                    placeholder="klik untuk mendapatkan total berat" required>
                @if($errors->has('total_berat'))
                <div class="invalid-feedback">
                    {{ $errors->first('total_berat') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.berat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo_manifes">{{ trans('cruds.penjualan.fields.photo_manifes') }} </label>
                <div class="needsclick dropzone {{ $errors->has('photo_manifes') ? 'is-invalid' : '' }}"
                    id="photo_manifes-dropzone">
                </div>
                @if($errors->has('photo_manifes'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo_manifes') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.photo_manifes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.penjualan.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video">{{ trans('cruds.penjualan.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                <div class="invalid-feedback">
                    {{ $errors->first('video') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.penjualan.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('konfirmasi') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="konfirmasi" id="konfirmasi" value="1"
                        {{ old('konfirmasi', 0) == 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label"
                        for="konfirmasi">{{ trans('cruds.penjualan.fields.konfirmasi') }}</label>
                </div>
                @if($errors->has('konfirmasi'))
                <div class="invalid-feedback">
                    {{ $errors->first('konfirmasi') }}
                </div>
                @endif
                @can('pabrikan-only')
                <span class="help-block">{{ trans('cruds.penjualan.fields.konfirmasi_pabrikan_helper') }}</span>
                @endcan
                @cannot('pabrikan-only')
                <span class="help-block">{{ trans('cruds.penjualan.fields.konfirmasi_helper') }}</span>
                @endcannot
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
    Dropzone.options.photoManifesDropzone = {
    url: '{{ route('admin.penjualans.storeMedia') }}',
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
        $('form').append('<input type="hidden" name="photo_manifes[]" value="' + response.name + '">')
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
      $('form').find('input[name="photo_manifes[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($penjualan) && $penjualan->photo_manifes)
var files = {!! json_encode($penjualan->photo_manifes) !!}
          for (var i in files) {
          var file = files[i]
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
    url: '{{ route('admin.penjualans.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
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
@if(isset($penjualan) && $penjualan->photo)
      var files = {!! json_encode($penjualan->photo) !!}
          for (var i in files) {
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
    url: '{{ route('admin.penjualans.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    acceptedFiles: '.mp4,.webm,.mkv,.avi,.3gp',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
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
@if(isset($penjualan) && $penjualan->video)
      var file = {!! json_encode($penjualan->video) !!}
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