@extends('layouts.admin')
@section('content')
@if (\Session::has('msg'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <span>{!! \Session::get('msg') !!}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                    name="username" id="username" value="{{ old('username', $user->username) }}" required>
                @if($errors->has('username'))
                <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                    name="password" id="password">
                @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_usaha_id">{{ trans('cruds.user.fields.nama_usaha') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nama_usaha') ? 'is-invalid' : '' }}"
                    name="nama_usaha_id[]" id="nama_usaha_id" required multiple>
                    @foreach($nama_usahas as $id => $jenis_usaha)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('nama_usaha', [])) || $user->jenis_usahas->contains($id)) ? 'selected' : '' }}>
                        {{ $jenis_usaha }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_usaha'))
                <span class="text-danger">{{ $errors->first('nama_usaha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.nama_usaha_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jenis_plastiks">{{ trans('cruds.user.fields.jenis_plastik') }}</label>
                @can('admin-only')
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select
                    class="form-control plastik-admin select2 {{ $errors->has('jenis_plastiks') ? 'is-invalid' : '' }}"
                    name="jenis_plastiks[]" id="jenis_plastiks" multiple required>
                    @foreach($jenis_plastiks as $id => $jenis_plastik)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('jenis_plastiks', [])) || $user->jenis_plastiks->contains($id)) ? 'selected' : '' }}>
                        {{ $jenis_plastik }}</option>
                    @endforeach
                </select>
                @endcan
                @cannot('admin-only')
                <select
                    class="form-control plastik-user select2 {{ $errors->has('jenis_plastiks') ? 'is-invalid' : '' }}"
                    name="jenis_plastiks[]" id="jenis_plastiks" multiple required>
                    @foreach($jenis_plastiks as $id => $jenis_plastik)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('jenis_plastiks', [])) || $user->jenis_plastiks->contains($id)) ? 'selected' : '' }}>
                        {{ $jenis_plastik }}</option>
                    @endforeach
                </select>
                @endcannot
                @if($errors->has('jenis_plastiks'))
                <span class="text-danger">{{ $errors->first('jenis_plastiks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.jenis_plastik_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alamat">{{ trans('cruds.user.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat"
                    id="alamat" value="{{ old('alamat', $user->alamat) }}" required>
                @if($errors->has('alamat'))
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                    id="email" value="{{ old('email', $user->email) }}">
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_tlp">{{ trans('cruds.user.fields.no_tlp') }}</label>
                <input class="form-control {{ $errors->has('no_tlp') ? 'is-invalid' : '' }}" type="text" name="no_tlp"
                    id="no_tlp" value="{{ old('no_tlp', $user->no_tlp) }}" required>
                @if($errors->has('no_tlp'))
                <span class="text-danger">{{ $errors->first('no_tlp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.no_tlp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_lampiran">{{ trans('cruds.user.fields.file_lampiran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_lampiran') ? 'is-invalid' : '' }}"
                    id="file_lampiran-dropzone">
                </div>
                @if($errors->has('file_lampiran'))
                <span class="text-danger">{{ $errors->first('file_lampiran') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.file_lampiran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="video">{{ trans('cruds.user.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                <span class="text-danger">{{ $errors->first('video') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.user.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text"
                    name="keterangan" id="keterangan" value="{{ old('keterangan', $user->keterangan) }}">
                @if($errors->has('keterangan'))
                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.keterangan_helper') }}</span>
            </div>
            @can('admin-only')
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]"
                    id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>
                        {{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            @endcan
            @cannot('admin-only')
            <input type="hidden" name="roles[]" value="2">
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

@section('scripts')
<script>
    var uploadedFileLampiranMap = {}
Dropzone.options.fileLampiranDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_lampiran[]" value="' + response.name + '">')
      uploadedFileLampiranMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileLampiranMap[file.name]
      }
      $('form').find('input[name="file_lampiran[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($user) && $user->file_lampiran)
          var files =
            {!! json_encode($user->file_lampiran) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_lampiran[]" value="' + file.file_name + '">')
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->photo)
      var file = {!! json_encode($user->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.videoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
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
@if(isset($user) && $user->video)
      var file = {!! json_encode($user->video) !!}
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
//disable select jenis plastik if role user
$('.plastik-user').prop('disabled', true);
</script>
@endsection