@extends('layouts.admin')
@section('content')
@can('penjualan_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.penjualans.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.penjualan.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.penjualan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form action="{{route('admin.penjualans.index')}}">
            @csrf
            @include('partials.filter-transaksi')
        </form>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Penjualan">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            {{ trans('cruds.penjualan.fields.tgl_jual') }}
                        </th>
                        @can('admin-only')
                        <th>
                            {{ trans('cruds.penjualan.fields.username') }}
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.penjualan.fields.nama_buyer') }}
                        </th>
                        <th>
                            Jenis Plastik
                        </th>
                        <th>
                            {{ trans('cruds.penjualan.fields.nama_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.penjualan.fields.total_berat') }}
                        </th>

                        @cannot('user-monitor')
                        <th>Photo Manifes</th>
                        @endcannot
                        <th>Photo</th>
                        <th>Video</th>

                        @cannot('user-monitor')
                        <th>
                            {{ trans('cruds.penjualan.fields.photo_manifes') }}
                        </th>
                        @endcannot
                        <th>
                            {{ trans('cruds.penjualan.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.penjualan.fields.video') }}
                        </th>
                        <th>
                            {{ trans('cruds.penjualan.fields.konfirmasi') }}
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
                    @foreach($penjualans as $key => $penjualan)
                    <tr>
                        <td>
                            {{$no++}}
                        </td>
                        <td>
                            {{ $penjualan->tgl_jual ?? '' }}
                        </td>
                        @can('admin-only')
                        <td>
                            {{ $penjualan->user->name ?? '' }}
                        </td>
                        @endcan
                        <td>
                            {{ $penjualan->nama_buyer->nama_buyer ?? '' }}
                        </td>
                        <td>
                            @foreach($penjualan->nama_plastiks as $key => $item)
                            {{ $item->nama_plastik }} - {{ $item->pivot->berat + 0 ?? '' }} Kg
                            @endforeach
                        </td>
                        <td>
                            @foreach($penjualan->nama_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}
                                <span class="badge badge-warning">{{ number($item->pivot->berat) ?? '' }}Kg</span>
                            </span>
                            @endforeach
                        </td>
                        <td>
                            {{ number($penjualan->total_berat) ?? '' }}
                        </td>

                        @cannot('user-monitor')
                        <td>
                            @if($penjualan->photo_manifes)
                            {{count($penjualan->photo_manifes)> 0 ? 'yes': 'no' }}
                            @endif
                        </td>
                        @endcannot

                        <td>
                            @if ($penjualan->photo)
                            {{count($penjualan->photo)> 0 ? 'yes': 'no' }}
                            @endif
                        </td>
                        <td>
                            {{ $penjualan->video !== null? 'yes': 'no' }}
                        </td>

                        @cannot('user-monitor')
                        <td>
                            @if($penjualan->photo_manifes)
                            @foreach($penjualan->photo_manifes as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                            @endif
                        </td>
                        @endcannot
                        <td>
                            @foreach($penjualan->photo as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                        </td>
                        <td>
                            @if($penjualan->video)
                            <a href="{{ $penjualan->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                        <td>
                            <span style="display:none">{{ $penjualan->konfirmasi ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $penjualan->konfirmasi ? 'checked' : '' }}>
                        </td>
                        <td>
                            @can('penjualan_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.penjualans.show', $penjualan->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('penjualan_edit')
                            @can('view', $penjualan)
                            <a class="btn btn-xs btn-info" href="{{ route('admin.penjualans.edit', $penjualan->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @endcan

                            @can('penjualan_delete')
                            @can('view',$penjualan)
                            <form action="{{ route('admin.penjualans.destroy', $penjualan->id) }}" method="POST"
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
                    <th>{{$item->pengumpulan}}</th>
                </tr>
                @endforeach
            </table>
            @endisset
        </div>
        <div class="col-lg-3 col-md-12 float-right">
            {{-- {{ $penjualans->appends(Request::all())->links() }} --}}
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('penjualan_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.penjualans.massDestroy') }}",
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
                        headers: { 'x-csrf-token': _token },
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    })
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
        let table = $('.datatable-Penjualan:not(.ajaxTable)').DataTable( {dom: 'Bfrtip', buttons: [
	  {
	    extend: 'excelHtml5',
	    text: 'Excel',
	    exportOptions: {
	       stripHtml: false,
           @can('admin-only')
           columns: [0, 1, 2, 3, 4, 6, 7, 8,9],
           @endcan
           @cannot('admin-only')
           columns: [0, 1, 2, 3 , 5, 6, 7,8],
           @endcannot
           @can('user-monitor')
           columns: [0, 1, 2, 3 , 5, 6, 7],
           @endcan
	       format: {
	         body: function ( data, column, row ) {
                 return  data.replaceAll("                                                        ", "");
	         }
	       }
	  	},
		  customize: function( xlsx ) {
		   		var sheet = xlsx.xl.worksheets['sheet1.xml'];
		      $('row c', sheet).attr( 's', '55' );
		   }
    },
    {
        extend: 'pdfHtml5',
        @can('admin-only')
        orientation: 'landscape',
        @endcan
        @cannot('admin-only')
        orientation: 'portrait',
        @endcannot
        title: 'LAPORAN PENJUALAN PLASTIK',
        exportOptions: {
           @can('admin-only')
           columns: [0, 1, 2, 3, 4, 6, 7, 8,9],
           @endcan
           @cannot('admin-only')
           columns: [0, 1, 2, 3 , 5, 6, 7,8],
           @endcannot
           @can('user-monitor')
           columns: [0, 1, 2, 3 , 5, 6, 7],
           @endcan
           format: {
	         body: function ( data, column, row ) {
                tags = data.replace(/<.*?>/g, "")
                trim =  tags.replaceAll("\n", "");
                space = trim.replaceAll("                                                                                    ","\r\n")
                kg = space.replaceAll("                                ","\r\n")
                return $.trim(kg);
                // return tags;
	         }
	       }
        }

    }
  ], scrollY: '70vh',scrollCollapse: true,scrollX: true, "searching": false })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        @can('admin-only')
            table.column(4).visible(false);
            table.column(7).visible(false);
            table.column(8).visible(false);
            table.column(9).visible(false);
        @endcan
        @cannot('admin-only')
            table.column(3).visible(false); 
            table.column(6).visible(false);
            table.column(7).visible(false);
            table.column(8).visible(false);
        @endcan
    })

</script>
@endsection