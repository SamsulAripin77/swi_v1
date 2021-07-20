<label for="kategori_plastik">Jenis plastik-Berat (Kg)</label>
<div class="row " id='jenis_plastik_id'>
  @foreach($nama_plastiks as $id => $nama_plastik)
  <div class="form-check col-md-3 pt-2">
    <label class="form-check-label" for="exampleCheck1">{{ $nama_plastik }}</label>
  </div>
  <div class="form-group col-md-3 d-flex flex-row">
    <input data-id="{{ $id }}" name="nama_plastiks[{{ $id }}]" type="number" value="{{ old('nama_plastiks.'.$id, 0) }}"
      step=".1" class="{{$nama_plastik}} plastiks-berat form-control" placeholder="Berat Plastik"
      required>&nbsp;&nbsp;&nbsp;<h5 class="pt-1">Kg
    </h5>
  </div>
  <div class="col-md-6">
  </div>
  @endforeach
</div>

<div class="form-group mt-3" id="deskripsi-container">

</div>

@section('scripts')
@parent
<script>
  $('document').ready(function () {
    let berat = document.querySelector('.plastiks-berat')
    if (berat.classList.contains('Olahan')){
      $('#deskripsi-container').append(`
      <div class="row">
        <div class="col-lg-3">
          <label class="required" for="deskripsi">{{ trans('cruds.penjualan.fields.deskripsi') }}</label>
          </div>
          <div class="col-lg-9">
            <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" class='form-control' {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"></textarea>
            </div>
            </div>
            @if($errors->has('deskripsi'))
            <div class="invalid-feedback">
              {{ $errors->first('deskripsi') }}
            </div>
              @endif
              <span class="help-block">{{ trans('cruds.penjualan.fields.deskripsi_helper') }}</span>
              `)
            }
            else {
              console.log('no')
            }
            $('.total-berat').focus(function () { let total = 0; document.querySelectorAll('.plastiks-berat').forEach(el => total += +el.value); document.querySelector('.total-berat').value = total.toFixed(2);})
  });
</script>
@endsection