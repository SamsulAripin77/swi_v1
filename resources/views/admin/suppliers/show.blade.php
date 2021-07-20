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
                            {{ $supplier->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.nama_supplier') }}
                        </th>
                        <td>
                            {{ $supplier->nama_supplier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.jenis_usaha') }}
                        </th>
                        <td>
                            {{ $supplier->jenis_usaha->nama_usaha ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.alamat') }}
                        </th>
                        <td>
                            {{ $supplier->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.no_telp') }}
                        </th>
                        <td>
                            {{ $supplier->no_telp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.jenis_plastik') }}
                        </th>
                        <td>
                            @foreach($supplier->jenis_plastiks as $key => $jenis_plastik)
                            <span class="label label-info">{{ $jenis_plastik->nama_plastik }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.sumber_sampah') }}
                        </th>
                        <td>
                            @foreach($supplier->sumber_sampahs as $key => $sumber_sampah)
                            <span class="label label-info">{{ $sumber_sampah->sumber_sampah }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.lokasi_sumber_sampah') }}
                        </th>
                        <td>
                            {{ $supplier->lokasi_sumber_sampah }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection