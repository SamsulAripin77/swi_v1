<div class="form-group">
    <label class="required" for="sumber_sampah">{{ trans('cruds.sumberSampah.fields.sumber_sampah') }}</label>
    <input class="form-control {{ $errors->has('sumber_sampah') ? 'is-invalid' : '' }}" type="text" name="sumber_sampah"
        id="sumber_sampah" value="{{ old('sumber_sampah', '') }}" required>
    @if($errors->has('sumber_sampah'))
    <span class="text-danger">{{ $errors->first('sumber_sampah') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.sumberSampah.fields.sumber_sampah_helper') }}</span>
</div>
<div class="form-group">
    <label for="keterangan">{{ trans('cruds.sumberSampah.fields.keterangan') }}</label>
    <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan"
        id="keterangan" value="{{ old('keterangan', '') }}">
    @if($errors->has('keterangan'))
    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.sumberSampah.fields.keterangan_helper') }}</span>
</div>