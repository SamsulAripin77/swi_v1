@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.penjualan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.penjualans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.id') }}
                        </th>
                        <td>
                            {{ $penjualan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.tgl_jual') }}
                        </th>
                        <td>
                            {{ $penjualan->tgl_jual }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.nama_buyer') }}
                        </th>
                        <td>
                            {{ $penjualan->nama_buyer->nama_buyer ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.nama_plastik') }}
                        </th>
                        <td>
                            @foreach($penjualan->nama_plastiks as $key => $nama_plastik)
                            <span class="badge badge-info">{{ $nama_plastik->nama_plastik }}
                                <span class="badge badge-warning">{{ number($nama_plastik->pivot->berat) ?? '' }}Kg</span>
                            </span>
                            @endforeach
                        </td>
                    </tr>
                    @can('pabrikan-only')
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.deskripsi') }}
                        </th>
                        <td>
                            {{ $penjualan->deskripsi }}
                        </td>
                    </tr>
                    @endcan
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.total_berat') }}
                        </th>
                        <td>
                            {{ number($penjualan->total_berat) ?? '' }}
                        </td>
                    </tr>
                    @can('admin-only')
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.photo_manifes') }}
                        </th>
                        <td>
                            @if($penjualan->photo_manifes)
                            @foreach($penjualan->photo_manifes as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    @endcan
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.photo') }}
                        </th>
                        <td>
                            @foreach($penjualan->photo as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.video') }}
                        </th>
                        <td>
                            @if($penjualan->video)
                            <a href="{{ $penjualan->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penjualan.fields.konfirmasi') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $penjualan->konfirmasi ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.penjualans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection