@extends('student/home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Learning Result</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                Dibawah ini merupakan rangkuman hasil anda mengerjakan exercise dan topic di dalam sistem ini.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover datatable-javaExerciseResult">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 2%"></th>
                                    <th style="width: 4%">ID</th>
                                    <th>Name</th>
                                    <th>Topic WorkOn</th>
                                    <th>Topic Passed</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                ajax: "{{ route('student.java.learning-result.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'topic_worked_on', name: 'topic_worked_on'},
                    {data: 'topic_passed', name: 'topic_passed'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
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
