@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.kemitraan.create') }}">
            Buat Kemitraan
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Daftar Kemitraan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kemitraan">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Tgl Beli
                        </th>
                        <th>
                            Nama User
                        </th>

                        <th>
                            Nama Mitra
                        </th>

                        <th>
                            Jenis Plastik
                        </th>
                        <th>
                            Total Berat
                        </th>
                        <th>
                            Photo
                        </th>

                        <th>
                            Video
                        </th>
                        <th>
                            Menyetujui
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kemitraans as $key => $kemitraan)
                    <tr data-entry-id="{{ $kemitraan->id }}">
                        <td>
                            {{$kemitraans->firstItem() + $key }}
                        </td>
                        <td>
                            {{ $kemitraan->tgl_beli ?? '' }}
                        </td>

                        <td>
                            @foreach($kemitraan->nama_users as $key => $item)
                            <span class="badge badge-info">{{ $item->name }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            {{ $kemitraan->nama_mitras->nama_mitra ?? '' }}
                        </td>
                        <td>
                            @foreach($kemitraan->jenis_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            {{ $kemitraan->total_berat ?? '' }}
                        </td>
                        <td>
                            @foreach($kemitraan->photo as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                        </td>
                        <td>
                            @if($kemitraan->video)
                            <a href="{{ $kemitraan->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                        <td>
                            <span style="display:none">{{ $kemitraan->menyetujui ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $kemitraan->menyetujui ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.kemitraan.show', $kemitraan->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.kemitraan.edit', $kemitraan->id) }}">
                                {{ trans('global.edit') }}
                            </a>



                            <form action="{{ route('admin.kemitraan.destroy', $kemitraan->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>

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
            {{ $kemitraans->appends(Request::all())->links() }}
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
    paging:false,
    "bPaginate": false
  });
  let table = $('.datatable-kemitraan:not(.ajaxTable)').DataTable({ buttons: dtButtons, scrollY: '80vh',scrollX: true })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection