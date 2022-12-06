@extends('student/home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Learning Result Detail </h3>
                </div>
                <div class="card-body">
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
                                    <h3>{{$javaExercise->topicPassed()}}</h3>
                                    <p>Topik Berhasil Dikerjakan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
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
                                <tr>
                                    <th style="width: 40%">Feedback Anda</th>
                                    <td style="width: 60%">{{ $feedback->suggestions ?? ''}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Daftar Topics</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable-javaTopics">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 2%"></th>
                                    <th style="width: 4%">ID</th>
                                    <th>Name</th>
                                    <th style="width: 10%">Test Path</th>
                                    <th style="width: 10%">Try Times</th>
                                    <th style="width: 10%">Status</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('student.java.learning-result.index') }}" class="btn btn-outline-info">Back</a>
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
                paging: false,
                searching: false,
                aaSorting: [],
                ajax: "{{ route('student.java.learning-result.topicAdapter', $javaExercise->id) }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'test_path', name: 'test_path'},
                    {data: 'trying_times', name: 'trying_times'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
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
