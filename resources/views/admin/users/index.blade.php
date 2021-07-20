@extends('layouts.admin')
@section('content')
@can('user_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.users.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-User" id="fixed-table">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.kode') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nama_usaha') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.jenis_plastik') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.no_tlp') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.file_lampiran') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.video') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr data-entry-id="{{ $user->id }}">
                        <td>
                            {{ $users->firstItem() + $key }}
                        </td>
                        <td>
                            {{ $user->kode ?? '' }}
                        </td>
                        <td>
                            {{ $user->username ?? '' }}
                        </td>
                        <td>
                            {{ $user->name,0,7 ?? '' }} ..
                        </td>
                        <td>
                            @foreach($user->jenis_usahas as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_usaha }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($user->jenis_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{ substr($user->alamat,0,10) ?? '' }} ..
                        </td>
                        <td>
                            {{ strtok($user->email,'@') ?? '' }}@
                        </td>
                        <td>
                            {{ $user->no_tlp ?? '' }}
                        </td>
                        <td>
                            @foreach($user->file_lampiran as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endforeach
                        </td>
                        <td>
                            @if($user->photo)
                            <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $user->photo->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($user->video)
                            <a href="{{ $user->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                        <td>
                            @foreach($user->roles as $key => $item)
                            <span class="badge badge-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('user_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('user_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('user_delete')
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
            {{ $users->links() }}
        </div>
    </div>
</div>



@endsection
@section('scripts')
{{-- @include('partials.jsDataTable'); --}}
{{-- @parent --}}
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons, scrollY: '70vh',
        scrollCollapse: true,
        scrollX: true,
        paging:         false })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection