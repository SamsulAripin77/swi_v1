<div class="row">
  <div class="form-check col col-md-3 col-sm-6">
    <label for="kategori_plastik">Nama/Jenis plastik</label>
  </div>
  <div class="form-group col col-md-3 col-sm-2">
    <span>Baseline</span>
  </div>
  <div class="form-group col col-md-3 col-sm-2">
    <span>Target</span>
  </div>
  <div class="form-group col col-md-3 col-sm-2">
    <span>insentif</span>
  </div>
</div>
<div class="row" id='jenis_plastik_id'>
  @foreach($nama_plastiks as $id => $nama_plastik)
  <div class="form-check col col-lg-3 pt-2">
    <label class="form-check-label" for="exampleCheck1">{{ $nama_plastik->nama_plastik }}</label>
  </div>
  <div class="form-group col col-lg-3">
    <input data-id="{{ $id }}" type="number" value="{{ $nama_plastik->baseline}}" class="plastiks-berat form-control"
      name="nama_plastiks[{{ $nama_plastik->id }}]" placeholder="Baseline (Kg)" required>
  </div>
  <div class="form-group col col-lg-3">
    <input data-id="{{ $id }}" type="number" value="{{ $nama_plastik->target}}" name="target{{$nama_plastik->id}}"
      class="plastiks-berat form-control" placeholder="Target (Kg)" required>
  </div>
  <div class="form-group col col-lg-3">
    <input data-id="{{ $id }}" type="number" value="{{ $nama_plastik->insentif}}" name="insentif{{$nama_plastik->id}}"
      class="plastiks-berat form-control" placeholder="Insetif/kg (Rp)" required>
  </div>
  @endforeach
</div>