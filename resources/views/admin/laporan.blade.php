@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{$label == 'Supplier' ? 'Laporan Pembelian' : 'Laporan Penjualan'}}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-9 col-md-4">
                @if ($label == 'Supplier')
                <form action="{{route('admin.pembelians.laporan')}}">
                    @else
                    <form action="{{route('admin.penjualans.laporan')}}">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                @if (!(Auth::user()->can('admin-only') || Auth::user()->can('user-monitor')))
                                <label class="required mr-3" for="user_id">Filter By Plastik</label>
                                <select class="form-control select2" name="plastik_id" id="plastik_id" required>
                                    @foreach($nama_plastiks as $id => $nama_plastik)
                                    <option value="{{$id}}">
                                        {{ $nama_plastik }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                                @if ((Auth::user()->can('admin-only') || Auth::user()->can('user-monitor')))
                                <label class="required mr-3" for="user_id">Filter By User</label>
                                <select class="form-control select2" name="user_id" id="user_id" required>
                                    @foreach($nama_users as $id => $nama_user)
                                    <option value="{{ $id}}">
                                        {{ $nama_user }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div class="col-lg-8">
                                @include('partials.filter-by-date')
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Pembelian">
                <thead>
                    <tr>
                        <th>
                            {{$label == 'Supplier'? 'Tgl Beli':'Tgl Jual'}}
                        </th>
                        @if ((Auth::user()->can('admin-only') || Auth::user()->can('user-monitor')))
                        <th>
                            {{ trans('cruds.pembelian.fields.username') }}
                        </th>
                        @endif
                        <th>
                            {{$label}}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.nama_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.pembelian.fields.total_berat') }}
                        </th>
                        @cannot('user-monitor')
                        <th>
                            Photo Manifes
                        </th>
                        @endcannot
                        <th>
                            Photo
                        </th>
                        <th>
                            Video
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $key => $transaksi)
                    <tr data-entry-id="{{ $key }}">
                        <td>
                            {{ $label == 'Supplier' ? $transaksi->tgl_beli : $transaksi->tgl_jual }}
                        </td>
                        @if ((Auth::user()->can('admin-only') || Auth::user()->can('user-monitor')))
                        <td>
                            {{ $transaksi->name ?? '' }}
                        </td>
                        @endif
                        <td>
                            {{$label =='Supplier' ? $transaksi->supplier : $transaksi->buyer }}
                        </td>
                        <td>
                            {{$transaksi->plastik}}
                        </td>
                        <td>
                            {{ number($transaksi->berat) ?? ''}}
                        </td>
                        @cannot('user-monitor')
                        <td>
                            {{ $transaksi->manifes ?? '' }}
                        </td>
                        @endcannot
                        <td>
                            {{ $transaksi->photo ?? '' }}
                        </td>
                        <td>
                            {{ $transaksi->video ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-12">

        </div>
        <div class="col-lg-3 col-md-12 float-right">

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
  let table = $('.datatable-Pembelian:not(.ajaxTable)').DataTable({dom: 'Bfrtip',
        buttons: [
            'excel', {extend: 'pdf', 
            @if ($label == 'Supplier')
                title: 'LAPORAN PEMBELIAN PLASTIK',
            @else
                title: 'LAPORAN PENJUALAN PLASTIK',
            @endif
        }
        ], scrollY: '70vh',scrollCollapse: true,scrollX: true, "searching": false })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>

@endsection