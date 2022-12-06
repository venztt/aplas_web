@extends('teacher/home')

@section('style')
    <style>
        pre {
            font-family: "Courier New", Courier, monospace;
        }
    </style>
@endsection

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Riwayat TopiK </h1>
                    Riwayat Topik {{ $javaExerciseTopic->name }}
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if (Session::has('message'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{--                        @dd($userTopics)--}}
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 5%">#</th>
                                    <th>Nama Siswa</th>
                                    <th style="width: 20%">Jumlah Percobaan</th>
                                    <th style="width: 20%">Passed</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    @foreach($userTopics as $index => $item)
                                        <td>{{$index}}</td>
                                        <td>{{$item['user']->name}}</td>
                                        <td>{{count($item['itemOk']) + count($item['itemFail'])}}</td>
                                        <td>{{ count($item['itemOk']) }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modal-users-index--{{ $index }}">
                                                Detail
                                            </button>
                                        </td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('teacher.java.exerciseTopicUsers.index') }}" class="btn btn-outline-info">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($userTopics as $index => $item)
            <div class="modal fade" id="modal-users-index--{{ $index }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $item['user']->name }} Riwayat Detail</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-1"><b>Riwayat Topik {{ $javaExerciseTopic->name }}</b></p>
                            <p class="mb-3">{{ $javaExerciseTopic->description }}</p>

                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1"><b>Eksekusi Kode Terakhir</b></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 float-right">{{ $item['itemLast'] !== null ? $item['itemLast']->created_at->diffForHumans() : ''}}</p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <pre>
                                        <code>
                                            {{$item['itemLast'] ? $item['itemLast']->raw : ''}}
                                        </code>
                                    </pre>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-1"><b>Hasil Koreksi JUnit4</b></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <p class="mb-1">{{$item['itemLast'] ? $item['itemLast']->report : ''}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection


@section('scripts')
    @parent

@endsection
