@extends('layouts.admin')
@section('content')
@can('supplier_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.data-mitra.create') }}">
            Buat Mitra
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        Daftar Mitra
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Supplier">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama Mitra
                        </th>
                        <th>
                            Nama User
                        </th>
                        <th>
                            Jenis Usaha
                        </th>
                        <th>
                            Alamat
                        </th>
                        <th>
                            No Hp
                        </th>
                        <th>
                            Jenis Plastik
                        </th>
                        <th>
                            Sumber Sampah
                        </th>
                        <th>
                            Lokasi Sampah
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_mitras as $key => $data_mitra)
                    <tr data-entry-id="{{$data_mitra->id}}">
                        <td>{{$data_mitras->firstItem() + $key }}</td>
                        <td>{{$data_mitra->nama_mitra}}</td>
                        <td>
                            @foreach($data_mitra->nama_users as $key => $item)
                            <span class="badge badge-info">{{ $item->name }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($data_mitra->jenis_usahas as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_usaha }}</span>
                            @endforeach
                        </td>
                        <td>{{$data_mitra->alamat}}</td>
                        <td>{{$data_mitra->no_hp}}</td>
                        <td>
                            @foreach($data_mitra->jenis_plastiks as $key => $item)
                            <span class="badge badge-info">{{ $item->nama_plastik }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($data_mitra->sumber_sampahs as $key => $item)
                            <span class="badge badge-info">{{ $item->sumber_sampah }}</span>
                            @endforeach
                        </td>
                        <td>{{$data_mitra->lokasi_sampah}}</td>
                        <td>
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.data-mitra.show', $data_mitra->id)  }}">
                                {{ trans('global.view') }}
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.data-mitra.edit', $data_mitra->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            <form action="{{ route('admin.data-mitra.destroy', $data_mitra->id) }}" method="POST"
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
            {{ $data_mitras->appends(Request::all())->links() }}
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('supplier_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                            let deleteButton = {
                            text: deleteButtonTrans,
                            url: "{{ route('admin.suppliers.massDestroy') }}",
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
                            let table = $('.datatable-Supplier:not(.ajaxTable)').DataTable({ buttons: dtButtons, scrollY: '80vh',scrollX: true })
                            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                            $($.fn.dataTable.tables(true)).DataTable()
                            .columns.adjust();
                            });

                            })

</script>
@endsection