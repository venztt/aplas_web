@extends('admin/admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">A Exercise Detail</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id">Topic Id</label>
                                <input id="id" type="text" value="{{ $exerciseTopic->id ?? ''}}" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <label for="name">Topic Name</label>
                                <input id="name" type="text" value="{{ $exerciseTopic->name ?? ''}}" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <label for="grade">Topic Grade</label>
                                <input id="grade" type="text" value="{{ $exerciseTopic->grade ?? ''}}" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <label for="file_path">File Path</label>
                                @if($exerciseTopic->file_path)
                                    <a class="btn btn-success form-control"
                                       href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->file_path, 'java'))}}">Download</a>
                                @else
                                    <p class="form-control">No file found</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="test_path">Test Path</label>
                                @if($exerciseTopic->test_path)
                                    <a class="btn btn-success form-control"
                                       href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exerciseTopic->test_path, 'java'))}}">Download</a>
                                @else
                                    <p class="form-control">No file found</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="java_exercise_id">Exercise</label>
                                <input id="java_exercise_id" type="text"
                                       value="{{ $exerciseTopic->javaExercise->name ?? ''}}" class="form-control" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="java_class_name">ClassName</label>
                                <input id="java_class_name" type="text"
                                       value="{{ $exerciseTopic->java_class_name ?? ''}}" class="form-control" disabled/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('teacher.java.exerciseTopicUser.index') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
