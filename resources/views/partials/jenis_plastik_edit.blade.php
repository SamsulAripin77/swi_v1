<label class="required">Jenis dan Berat</label>
<div class="row">
  @if (isset($pembelian))
  @foreach($nama_plastiks as $id => $nama_plastik)
  <div class="form-check col-md-3 pt-2">
    <label class="form-check-label" for="exampleCheck1">{{ $nama_plastik->nama_plastik }}</label>
  </div>
  <div class="form-group col-md-3 d-flex flex-row">
    <input data-id="{{ $nama_plastik->id }}" name="nama_plastiks[{{$nama_plastik->id}}]" type="number" step=".1"
      value="{{  $nama_plastik->berat }}" class="plastiks-berat form-control" placeholder="berat"
      required>&nbsp;&nbsp;&nbsp;<h5 class="pt-1">Kg
    </h5>
  </div>
  <div class="col-md-6">
  </div>
  @endforeach
  @else
  @foreach($nama_plastiks as $id => $nama_plastik)
  <div class="form-check col-md-3 pt-2">
    <label class="form-check-label" for="exampleCheck1">{{ $nama_plastik->nama_plastik }}</label>
  </div>
  <div class="form-group col-md-3 d-flex flex-row">
    <input data-id="{{ $nama_plastik->id }}" name="nama_plastiks[{{$nama_plastik->id}}]" type="number" step=".1"
      value="{{ old('nama_plastiks.'.$id, $nama_plastik->berat)   }}"
      class="plastiks-berat form-control {{$nama_plastik->nama_plastik}}" placeholder="berat"
      required>&nbsp;&nbsp;&nbsp;<h5 class="pt-1">Kg
    </h5>
  </div>
  <div class="col-md-6">
  </div>
  @endforeach
  @endif

</div>
@if($errors->has('nama_plastiks'))
<div class="invalid-feedback">
  {{ $errors->first('nama_plastiks') }}
</div>
@endif

@section('scripts')
@parent
<script>
  $('document').ready(function () {
    let totalBerat = 0
    $('.total-berat').focus(function () { let total = 0; document.querySelectorAll('.plastiks-berat').forEach(el => total += +el.value); document.querySelector('.total-berat').value = total; console.log(total); })
  });
</script>
@endsection