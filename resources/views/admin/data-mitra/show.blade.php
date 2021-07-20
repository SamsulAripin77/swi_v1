@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supplier.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.id') }}
                        </th>
                        <td>
                            {{ $dataMitra->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Mitra
                        </th>
                        <td>
                            {{ $dataMitra->nama_mitra ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama User
                        </th>
                        <td>
                            {{ $dataMitra->nama_users->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.alamat') }}
                        </th>
                        <td>
                            {{ $dataMitra->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.no_telp') }}
                        </th>
                        <td>
                            {{ $dataMitra->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jenis usaha
                        </th>
                        <td>
                            @foreach($dataMitra->jenis_usahas as $key => $jenis_usaha)
                            <span class="label label-info">{{ $jenis_usaha->nama_usaha }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.jenis_plastik') }}
                        </th>
                        <td>
                            @foreach($dataMitra->jenis_plastiks as $key => $jenis_plastik)
                            <span class="label label-info">{{ $jenis_plastik->nama_plastik }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.sumber_sampah') }}
                        </th>
                        <td>
                            @foreach($dataMitra->sumber_sampahs as $key => $sumber_sampah)
                            <span class="label label-info">{{ $sumber_sampah->sumber_sampah }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.lokasi_sumber_sampah') }}
                        </th>
                        <td>
                            {{ $dataMitra->lokasi_sampah }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-mitra.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection