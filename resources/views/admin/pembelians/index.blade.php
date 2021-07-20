@extends('layouts.admin')
@section('styles')
@include('partials.cssTable')
@endsection
@section('content')
@can('pembelian_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.pembelians.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.pembelian.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pembelian.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form action="{{route('admin.pembelians.index')}}">
            @csrf
            @include('partials.filter-transaksi')
        </form>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Pembelian">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.tgl_beli') }}
                        </th>
                        @can('admin-only')
                        <th>
                            {{ trans('cruds.pembelian.fields.username') }}
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.pembelian.fields.nama_supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.nama_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.total_berat') }}
                        </th>
                        @cannot('user-monitor')
                        <th>
                            {{ trans('cruds.pembelian.fields.photo_manifes') }}
                        </th>
                        @endcannot
                        <th>
                            {{ trans('cruds.pembelian.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.video') }}
                        </th>
                        @cannot('user-monitor')          
                        <th>
                            {{ trans('cruds.pembelian.fields.photo_manifes') }}
                        </th>
                        @endcannot
                        <th>
                            {{ trans('cruds.pembelian.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.video') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                $no = 1;
                @endphp
                <tbody>
                    @foreach($pembelians as $key => $pembelian)
                    <tr data-entry-id="{{ $pembelian->id }}">
                        <td>
                            {{$no++}}
                        </td>
                        <td>
                            {{ $pembelian->tgl_beli ?? '' }}
                        </td>
                        @can('admin-only')
                        <td>
                            {{ $pembelian->user->name ?? '' }}
                        </td>
                        @endcan
                        <td>
                            {{ $pembelian->nama_supplier->nama_supplier ?? '' }}
                        </td>
                        <td>
                            @foreach($pembelian->nama_plastiks as $key => $nama_plastik)
                            <span class="badge badge-info">{{ $nama_plastik->nama_plastik ?? '' }}
                                <span class="badge badge-warning">{{number($nama_plastik->pivot->berat)}} Kg</span>
                            </span>
                            @endforeach
                        </td>
                        <td>
                            {{number($pembelian->total_berat)}}
                        </td>
                        @cannot('user-monitor')
                        <td>
                            @if($pembelian->photo_manifes)
                            {{count($pembelian->photo_manifes)> 0 ? 'yes': 'no' }}
                            @endif
                        </td>
                        @endcannot
                        <td>
                            @if ($pembelian->photo)
                            {{count($pembelian->photo)> 0 ? 'yes': 'no' }}
                            @endif
                        </td>
                        <td>
                            {{ $pembelian->video !== null? 'yes': 'no' }}
                        </td>
                        @cannot('user-monitor')
                        <td>
                            @if($pembelian->photo_manifes)
                            @foreach($pembelian->photo_manifes as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                            @endif
                        </td>
                        @endcannot
                        <td>
                            @foreach($pembelian->photo as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                        </td>
                        <td>
                            @if($pembelian->video)
                            <a href="{{ $pembelian->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                        <td>
                            @can('pembelian_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.pembelians.show', $pembelian->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('pembelian_edit')
                            @can('view', $pembelian)
                            <a class="btn btn-xs btn-info" href="{{ route('admin.pembelians.edit', $pembelian->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @endcan
                            @can('pembelian_delete')
                            @can('view',$pembelian)

                            <form action="{{ route('admin.pembelians.destroy', $pembelian->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if (Auth::user()->roles->where('title', '=', 'User')->count() > 0)
    <div class="row">
        <div class="col-lg-9 col-md-12 px-4 pb-3">
            @isset($aggregate)
            <table>
                <tr width="10">
                    <th colspan="2">Pengumpulan</th>
                </tr>
                
                @foreach ($aggregate as $key => $item)
                <tr>
                    <td>{{$item->nama_plastik}}</td>
                    <td>:</td>
                    <th>{{$item->pengumpulan + 0 ?? ''}}</th>
                </tr>
                @endforeach
                
            </table>
            @endisset
        </div>
        <div class="col-lg-3 col-md-12 float-right">
            
        </div>
    </div>
    @endif
</div>
@endsection
@section('scripts')
@parent
{{-- @include('partials.js-table'); --}}
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('pembelian_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pembelians.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    pageLength: 100,
    "bPaginate": false
  });
  var table = $('.datatable-Pembelian:not(.ajaxTable)').DataTable(
      {dom: 'Bfrtip', buttons: [
	  {
	    extend: 'excelHtml5',
	    text: 'Excel',
	    exportOptions: {
	       stripHtml: false,
           @can('admin-only')
           columns: [0, 1, 2, 3, 4, 5, 6, 7,8],
           @endcan
           @cannot('admin-only')
           columns: [0, 1, 2, 3 , 4, 5, 6,7],
           @endcannot
	       format: {
	         body: function ( data, column, row ) {
                tags = data.replace(/<.*?>/g, "")
                trim =  tags.replaceAll("\n", "");
                space = trim.replaceAll("                                                                                    ","\r\n")
                kg = space.replaceAll("                                "," - ")
                return $.trim(kg);
                // return tags;
	         }
	       }
	  	},
		  customize: function( xlsx ) {
		   		var sheet = xlsx.xl.worksheets['sheet1.xml'];
		      $('row c', sheet).attr( 's', '55' );
		   }
    },
    {
        extend: 'pdf',
        title: 'LAPORAN PEMBELIAN',
        exportOptions: {
           @can('admin-only')
           columns: [0, 1, 2, 3, 4, 5, 6, 7,8],
           @endcan
           @cannot('admin-only')
           columns: [0, 1, 2, 3 , 4, 5, 6,7],
           @endcannot
           format: {
	         body: function ( data, column, row ) {
                tags = data.replace(/<.*?>/g, "")
                trim =  tags.replaceAll("\n", "");
                space = trim.replaceAll("                                                                                    ","\r\n")
                kg = space.replaceAll("                                "," - ")
                return $.trim(kg);
	         }
	       }
        }
    }
  ], scrollY: '70vh',scrollCollapse: true,scrollX: true, "searching": false })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  @can('admin-only')
     table.column(6).visible(false);
     table.column(7).visible(false);
     table.column(8).visible(false);
  @endcan
  @cannot('admin-only')
     table.column(5).visible(false);
     table.column(6).visible(false);
     table.column(7).visible(false);
  @endcan
  
})

</script>
@endsection