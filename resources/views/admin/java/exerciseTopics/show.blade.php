@extends('admin/admin')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>A Topics Detail</h1>
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
                                    <th style="width: 40%">ID Topik</th>
                                    <td style="width: 60%">{{ $exerciseTopic->id ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Nama</th>
                                    <td style="width: 60%">{{ $exerciseTopic->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Tingkatan</th>
                                    <td style="width: 60%">{{ $exerciseTopic->grade ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Modul</th>
                                    <td style="width: 60%">{{ $exerciseTopic->javaExercise->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">ClassName</th>
                                    <td style="width: 60%">{{ $exerciseTopic->java_class_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">File Path</th>
                                    <td style="width: 60%">
                                        @if($exerciseTopic->file_path)
                                            <a class="btn btn-success form-control"
                                               href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->file_path, 'java'))}}">Download</a>
                                        @else
                                            <p class="form-control">No file found</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Test Path</th>
                                    <td style="width: 60%">
                                        @if($exerciseTopic->test_path)
                                            <a class="btn btn-success form-control"
                                               href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->test_path, 'java'))}}">Download</a>
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
