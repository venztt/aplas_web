@extends('admin/admin')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>A Exercise Detail</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">ID Modul</th>
                                    <td style="width: 60%">{{ $exercise->id ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Nama Modul</th>
                                    <td style="width: 60%">{{ $exercise->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Tingkatan</th>
                                    <td style="width: 60%">{{ $exercise->grade ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th style="width: 40%">Path Modul</th>
                                    <td style="width: 60%">
                                        @if($exercise->module_path)
                                            <a class="btn btn-success form-control"
                                               href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exercise->module_path, 'java'))}}">Download</a>
                                        @else
                                            <p class="form-control">No file found</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
