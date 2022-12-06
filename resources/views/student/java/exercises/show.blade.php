@extends('student/home')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Keterangan Modul</h1>
                    Setiap Modul mempunyai beberapa topic yang dapat di kerjakan.
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
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        Silahkan pilihlah topic yang ingin anda pelajari
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">Nama Modul</th>
                                    <td style="width: 60%">{{ $javaExercise->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Tingkatan</th>
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
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th style="width: 10%">Test Path</th>
                                    <th style="width: 10%">Java Exercise</th>
                                    <th style="width: 10%">Actions</th>
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
                autoWidth: false,
                responsive: true,
                lengthChange: false,
                ajax: "{{ route('student.java.exercise.topicAdapter', $javaExercise->id) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'test_path', name: 'test_path'},
                    {data: 'java_exercise_id', name: 'java_exercise_id'},
                    {data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false}
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
