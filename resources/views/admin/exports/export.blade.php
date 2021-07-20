<style>

</style>
@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>Export Laporan Pembelian</h3>
    </div>

<div class="card-body">
<form action="{{route('admin.pembelians.export-pembelian')}}">
@csrf
@include('partials.filter-transaksi')
</form>
<div class="table-responsive">
<table cellspacing="0" border="0" class="table table-bordered table-striped table-hover datatable datatable-Pembelian">
	<thead>
	<tr>
		<th rowspan="2" height="77" align="center" valign=middle><b>No</b></th>
		<th rowspan="2" ><b>Tanggal Beli</b></th>
		<th rowspan="2" ><b>Nama</b></th>
		@if ($label == 'pembelian')
		<th rowspan="2" ><b>Nama Supplier</b></th>
		@else
		<th rowspan="2" ><b>Nama Buyer</b></th>
		@endif
		<th class="text-center" style="border-bottom: none"  colspan={{$plastiks->count()}}>Jenis Plastik</th>
		<th rowspan="2" ><b>Total Berat</b></th>
		<th rowspan="2" ><b>Photo Manifes</b></th>
		<th rowspan="2" ><b>Photo</b></th>
		<th rowspan="2" ><b>Video</b></th>
	</tr>
	<tr>
	@foreach ($plastiks as $item)
	<th align="center" valign="middle"><b>{{$item->nama_plastik }} Kg</b></th>
	@endforeach
	</tr>
	</thead>
	<tbody>
	@foreach ($transaksis as $key => $item)
		<tr>
			<td>{{$item->id}}</td>
			<td>{{$item->tgl_beli}}</td>
			<td>{{$item->user->name}}</td>
			<td>{{$item->nama_supplier->nama_supplier}}</td>
			@foreach ($plastiks as $plastik)
				<td align="center" valign=middle>
				@if (in_array($plastik->id, $item->nama_plastiks->pluck('id')->toArray()))
					{{$item->nama_plastiks->where('id',$plastik->id)->first()->pivot->berat}}
				@else
					0
				@endif
			</td>
			@endforeach
			<td>{{$item->total_berat}}</td>
			<td>
				@if($item->photo_manifes)
				{{count($item->photo_manifes)> 0 ? 'yes': 'no' }}
				@endif
			</td>
			<td>
				@if ($item->photo)
				{{count($item->photo)> 0 ? 'yes': 'no' }}
				@endif
			</td>
			<td>
				{{ $item->video !== null? 'yes': 'no' }}
			</td>
		</tr>
	@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection

@section('scripts')
@parent
{{-- @include('partials.js-table'); --}}
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    pageLength: 100,
    "bPaginate": false
  });
  let table = $('.datatable-Pembelian:not(.ajaxTable)').DataTable({"orderCellsTop": true,dom: 'Bfrtip',
        buttons: [
            'excel',
        ], scrollY: '70vh',scrollCollapse: true,scrollX: true, "searching": false })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection