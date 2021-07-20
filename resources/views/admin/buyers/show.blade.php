@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.buyer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buyers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.id') }}
                        </th>
                        <td>
                            {{ $buyer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.nama_buyer') }}
                        </th>
                        <td>
                            {{ $buyer->nama_buyer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.jenis_usaha') }}
                        </th>
                        <td>
                            {{ $buyer->jenis_usaha->nama_usaha ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.alamat') }}
                        </th>
                        <td>
                            {{ $buyer->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.no_telp') }}
                        </th>
                        <td>
                            {{ $buyer->no_telp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.jenis_plastik') }}
                        </th>
                        <td>
                            @foreach($buyer->jenis_plastiks as $key => $jenis_plastik)
                                <span class="label label-info">{{ $jenis_plastik->nama_plastik }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.sumber_sampah') }}
                        </th>
                        <td>
                            @foreach($buyer->sumber_sampahs as $key => $sumber_sampah)
                                <span class="label label-info">{{ $sumber_sampah->sumber_sampah }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyer.fields.lokasi_sumber_sampah') }}
                        </th>
                        <td>
                            {{ $buyer->lokasi_sumber_sampah }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buyers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection