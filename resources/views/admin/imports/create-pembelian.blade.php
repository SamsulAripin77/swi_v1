@extends('layouts.admin')

@section('content')
<div class="container"></div>
<div class="justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Import Excel</div>
            <div class="card-body">
                @if (session('info'))
                <div class="alert alert-success" role='alert'>
                    {{session('info')}}
                </div>
                @endif
                @if (session()->has('failures'))
                <table class="table table-danger">
                    <tr>
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Errors</th>
                        <th>value</th>
                    </tr>
                    @foreach (session()->get('failures') as $validation)
                    <tr>
                        <td>{{$validation->row()}}</td>
                        <td>{{$validation->attribute()}}</td>
                        <td>
                            <ul>
                                @foreach ($validation->errors() as $e)
                                <li>{{$e}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$validation->values()[$validation->attribute()]}}</td>
                    </tr>
                    @endforeach
                </table>
                @endif
                <form action="" method="post" enctype="multipart/form-data">
                    <form action="{{ route('admin.imports.pembelian-store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-inline">
                            <input type="file" name="file" class="form-control mr-2">
                            <button type="submit" class="btn btn-primary">import</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection