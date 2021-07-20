@extends('layouts.admin')
@section('content')
@can('baseline_target_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.baseline-targets.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.baselineTarget.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.baselineTarget.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BaselineTarget">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.nama_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.jenis_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.baseline') }}
                        </th>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.target') }}
                        </th>
                        <th>
                            {{ trans('cruds.baselineTarget.fields.insentif') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baselineTargets as $key => $baselineTarget)
                    <tr data-entry-id="{{ $baselineTarget->id }}">
                        <td>
                            {{ $baselineTargets->firstItem() + $key }}
                        </td>
                        <td>
                            {{ $baselineTarget->nama_user->name ?? '' }}
                        </td>
                        <td>
                            @foreach($baselineTarget->nama_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}</span><br>
                            @endforeach
                        </td>

                        <td>
                            @foreach($baselineTarget->nama_plastiks as $key => $item)
                            <span class="badge badge-info">@ribuan($item->pivot->baseline)</span><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($baselineTarget->nama_plastiks as $key => $item)
                            <span class="badge badge-info">@ribuan($item->pivot->target)</span><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($baselineTarget->nama_plastiks as $key => $item)
                            <span class="badge badge-info">@ribuan($item->pivot->insentif)</span><br>
                            @endforeach
                        </td>
                        <td>
                            @can('baseline_target_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.baseline-targets.show', $baselineTarget->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('baseline_target_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.baseline-targets.edit', $baselineTarget->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('baseline_target_delete')
                            <form action="{{ route('admin.baseline-targets.destroy', $baselineTarget->id) }}"
                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
            {{ $baselineTargets->appends(Request::all())->links() }}
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('baseline_target_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.baseline-targets.massDestroy') }}",
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
  let table = $('.datatable-BaselineTarget:not(.ajaxTable)').DataTable({ buttons: dtButtons, scrollY: '80vh', scrollCollapse: true})
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})
</script>
@endsection