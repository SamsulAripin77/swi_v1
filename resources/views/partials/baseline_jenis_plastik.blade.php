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

</div>

@section('scripts')
@parent

<script>
  window.addEventListener('DOMContentLoaded', () => {
    $(function () {
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
      $('#nama_user_id').change(() => {

        $.ajax({
          url: "{{route('admin.baseline.dependend-dropdown')}}",
          method: 'POST',
          data: { user: $('#nama_user_id').val() },
          success: function (response) {
            // console.log(response)
            createPlastik(response)
          },
          error: function (error) {
            console.log('error')
          }
        })
      })
    })

    function createPlastik(data) {
      $('#jenis_plastik_id').empty()
      data.forEach(item => {
        $('#jenis_plastik_id').append(
          `
          <div class="form-check col col-md-3 col-sm-6 pt-2">
          <label class="form-check-label" for="exampleCheck1">${item.nama_plastik}</label>
          </div>
          <div class="form-group col col-md-3 col-sm-2">
            <input value="0" data-id="${item.id}" type="number" 
              class="plastiks-berat form-control" name="nama_plastiks[${item.id}]" placeholder="Baseline (Kg)" required>
          </div>
          <div class="form-group col col-md-3 col-sm-2">
            <input value="0" data-id="${item.id}" type="number" 
              name="target${item.id}" class="plastiks-berat form-control" placeholder="Target (Kg)" required>
          </div>
          <div class="form-group col col-md-3 col-sm-2">
            <input value="0" data-id="${item.id}" type="number" 
              name="insentif${item.id}" class="plastiks-berat form-control" placeholder="Insentif/kg (Rp)" required>
          </div>
        `
        )
      })
    }
  })
</script>
@endsection