@extends('teacher/home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Topic {{ $javaExerciseTopic->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>Student Name</th>
                                    <th>Trying Count</th>
                                    <th>Module Path</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('teacher.java.exerciseTopicUsers.index') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @parent

@endsection
