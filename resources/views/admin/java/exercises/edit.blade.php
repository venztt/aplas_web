@extends('admin/admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('admin.java.exercise.update', $exercise->id) }}"
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
                                    <label for="name">Exercise Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Topic Name"
                                           value="{{ old('name', $exercise->name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control" name="grade" placeholder="Enter Topic Grade"
                                           value="{{ old('grade', $exercise->grade) }}">
                                </div>
                                <div class="form-group">
                                    <label for="grade">Module</label>
                                    <input type="file" class="form-control" name="module_path" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.java.exercise.index') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
