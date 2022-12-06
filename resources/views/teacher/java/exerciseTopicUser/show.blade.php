@extends('teacher/home')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{$javaExercise->name}} Result </h1>
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
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$javaExercise->topicWorkedOn()}}</h3>
                            <p>Keseluruhan Topic</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$javaExercise->topicPassedTeacher()}}</h3>
                            <p>Siswa Berhasil Mengerjakan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">Name</th>
                                    <td style="width: 60%">{{ $javaExercise->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Grade</th>
                                    <td style="width: 60%">{{ $javaExercise->grade ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Module</th>
                                    <td style="width: 60%">
                                        @if($javaExercise->module_path)
                                            <a class="btn btn-success "
                                               href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($javaExercise->module_path, 'java'))}}">Download</a>
                                        @else
                                            <p>No file found</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-dark">
                                Daftar Topic
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline datatable-javaTopics">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">#</th>
                                    <th>Nama Topik</th>
                                    <th style="width: 10%">File Path</th>
                                    <th style="width: 10%">Test Path</th>
                                    <th style="width: 10%">Modul</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                paging: false,
                searching: false,
                aaSorting: [],
                ajax: "{{ route('teacher.java.exerciseTopicUsers.topicAdapter', $javaExercise->id) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'test_path', name: 'test_path'},
                    {data: 'java_exercise_id', name: 'java_exercise_id'},
                    {data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable:false}
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 10,
            };
            let table = $('.datatable-javaTopics').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });
    </script>
@endsection
