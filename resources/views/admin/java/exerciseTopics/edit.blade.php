@extends('admin/admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('admin.java.topic.update', $exerciseTopic->id) }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Change Data of Exercise</h3>
                    </div>
                    <div class="card-body">
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                <ul>{{$errors->first()}}</ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Topic Name</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $exerciseTopic->name) }}"
                                           placeholder="Enter exercise name"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Topic Description</label>
                                    <textarea class="form-control" name="description">{{ old('description', $exerciseTopic->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file_path">Java File</label>
                                    <input type="file" class="form-control" name="file_path"/>
                                </div>
                                <div class="form-group">
                                    <label for="test_path">JUnit File</label>
                                    <input type="file" class="form-control" name="test_path"/>
                                </div>
                                <div class="form-group">
                                    <label for="test_path">JUnit File</label>
                                    <select name="java_exercise_id" class="form-control">
                                        @foreach($javaExercise as $id => $exercise)
                                            <option
                                                value="{{ $id }}" {{ (old('java_exercise_id') ?
                                                 old('java_exercise_id') : $id ?? '') == $id ?
                                                 'selected' : '' }}>{{ $exercise }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.java.topic.index') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
