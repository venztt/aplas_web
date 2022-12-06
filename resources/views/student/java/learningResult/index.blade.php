@extends('student/home')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Learning Result</h1>
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
                        Dibawah ini merupakan rangkuman hasil anda mengerjakan exercise dan topic di dalam sistem ini.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline datatable-javaExerciseResult">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">#</th>
                                    <th>Nama Modul</th>
                                    <th>Tingkat</th>
                                    <th>Topic Tersedia</th>
                                    <th>Topic Berhasil</th>
                                    <th style="width: 15%">Actions</th>
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
                aaSorting: [],
                autoWidth: false,
                responsive: true,
                lengthChange: false,
                ajax: "{{ route('student.java.learning-result.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'grade', name: 'grade'},
                    {data: 'topic_worked_on', name: 'topic_worked_on'},
                    {data: 'topic_passed', name: 'topic_passed'},
                    {data: 'actions', name: '{{ trans('global.actions') }}', orderable: false, searchable: false }
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 10,
            };
            let table = $('.datatable-javaExerciseResult').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });
    </script>
@endsection
