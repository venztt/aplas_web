@extends('admin/admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.java.topic.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Exercise Topic</h3>
                    </div>
                    <div class="card-body">
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                <ul>{{ $errors->first() }}</ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Topic Name</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Enter exercise name"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Topic Description</label>
                                    <textarea class="form-control" name="description"></textarea>
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
                                    <label for="java_class_name">ClassName</label>
                                    <input type="text" class="form-control" name="java_class_name"
                                           value="{{ old('java_class_name') }}"
                                           placeholder="Classname name"/>
                                </div>
                                <div class="form-group">
                                    <label for="test_path">JUnit File</label>
                                    <select name="java_exercise_id" class="form-control">
                                        @foreach($javaExercise as $id => $exercise)
                                            <option value="{{ $id }}">{{ $exercise }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" value="Back" onclick="history.back()" class="btn btn-outline-info">
                        <button class="btn btn-primary pull-right" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
