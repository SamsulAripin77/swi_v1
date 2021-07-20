@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pembelian.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pembelians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.id') }}
                        </th>
                        <td>
                            {{ $pembelian->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.tgl_beli') }}
                        </th>
                        <td>
                            {{ $pembelian->tgl_beli }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.nama_supplier') }}
                        </th>
                        <td>
                            {{ $pembelian->nama_supplier->nama_supplier ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.nama_plastik') }}
                        </th>
                        <td>
                            @foreach($pembelian->nama_plastiks as $key => $nama_plastik)
                            <span class="badge badge-info">{{ $nama_plastik->nama_plastik }}
                                <span class="badge badge-warning">{{ number($nama_plastik->pivot->berat)}} Kg</span>
                            </span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.total_berat') }}
                        </th>
                        <td>
                            {{ $pembelian->total_berat + 0 ?? ''}} <span>Kg</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status Plastik
                        </th>
                        <td>
                            {{$pembelian->status_plastik}}
                        </td>
                    </tr>
                    @can('admin-only')
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.photo_manifes') }}
                        </th>
                        <td>
                            @if ($pembelian->photo_manifes)
                            @foreach($pembelian->photo_manifes as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank"
                                style="display: inline-block; margin-right: 10px">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    @endcan
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.photo') }}
                        </th>
                        <td>
                            @foreach($pembelian->photo as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank"
                                style="display: inline-block; margin-right: 10px">
                                <img src="{{ $media->getUrl('thumb') }}">
                            </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.video') }}
                        </th>
                        <td>
                            @if($pembelian->video)
                            <a href="{{ $pembelian->video->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembelian.fields.konfirmasi') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $pembelian->konfirmasi ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pembelians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection