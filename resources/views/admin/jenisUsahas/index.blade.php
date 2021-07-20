@extends('layouts.admin')
@section('content')
@can('jenis_usaha_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.jenis-usahas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.jenisUsaha.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.jenisUsaha.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-JenisUsaha">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.nama_usaha') }}
                        </th>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.kode') }}
                        </th>
                        <th>
                            {{ trans('cruds.jenisUsaha.fields.keterangan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenisUsahas as $key => $jenisUsaha)
                    <tr data-entry-id="{{ $jenisUsaha->id }}">
                        <td>
                            {{ $jenisUsaha->nama_usaha ?? '' }}
                        </td>
                        <td>
                            {{ $jenisUsaha->kode ?? '' }}
                        </td>
                        <td>
                            {{ $jenisUsaha->keterangan ?? '' }}
                        </td>
                        <td>
                            @can('jenis_usaha_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.jenis-usahas.show', $jenisUsaha->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('jenis_usaha_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.jenis-usahas.edit', $jenisUsaha->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('jenis_usaha_delete')
                            <form action="{{ route('admin.jenis-usahas.destroy', $jenisUsaha->id) }}" method="POST"
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
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('jenis_usaha_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.jenis-usahas.massDestroy') }}",
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
  });
  let table = $('.datatable-JenisUsaha:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection