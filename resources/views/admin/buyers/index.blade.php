@extends('layouts.admin')
@section('content')
@can('buyer_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.buyers.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.buyer.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.buyer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Buyer">
                <thead>
                    <tr>
                        <th width="10">
                            No
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.nama_buyer') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.jenis_usaha') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.no_telp') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.jenis_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.sumber_sampah') }}
                        </th>
                        <th>
                            {{ trans('cruds.buyer.fields.lokasi_sumber_sampah') }}
                        </th>
                        @can('admin-only')
                        <th>
                            {{ trans('cruds.buyer.fields.id_user') }}
                        </th>
                        @endcan
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyers as $key => $buyer)
                    <tr data-entry-id="{{ $buyer->id }}">
                        <td>
                            {{ $buyers->firstItem() + $key }}
                        </td>
                        <td>
                            {{ $buyer->nama_buyer ?? '' }}
                        </td>
                        <td>
                            {{ $buyer->jenis_usaha->nama_usaha ?? '' }}
                        </td>
                        <td>
                            {{ $buyer->alamat ?? '' }}
                        </td>
                        <td>
                            {{ $buyer->no_telp ?? '' }}
                        </td>
                        <td>
                            @foreach($buyer->jenis_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($buyer->sumber_sampahs as $key => $item)
                            <span class="badge badge-info">{{ $item->sumber_sampah }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{ $buyer->lokasi_sumber_sampah ?? '' }}
                        </td>
                        @can('admin-only')
                        <td>
                            @foreach($buyer->id_users as $key => $item)
                            <span class="badge badge-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                        @endcan
                        <td>
                            @can('buyer_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.buyers.show', $buyer->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('buyer_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.buyers.edit', $buyer->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('buyer_delete')
                            <form action="{{ route('admin.buyers.destroy', $buyer->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

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
            {{ $buyers->appends(Request::all())->links() }}
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('buyer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.buyers.massDestroy') }}",
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
    paging:false,
    "bPaginate": false
  });
  let table = $('.datatable-Buyer:not(.ajaxTable)').DataTable({ buttons: dtButtons, scrollY: '80vh',scrollX: true })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection