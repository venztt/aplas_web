@extends('admin/admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.java.exercise.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Exercise</h3>
                    </div>
                    <div class="card-body">
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                <ul>{{ $errors->all() }}</ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Exercise Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter exercise name" />
                                </div>
                                <div class="form-group">
                                    <label for="grade">Exercise Grade</label>
                                    <input type="text" class="form-control" name="grade" placeholder="Enter Stage Name" />
                                </div>
                                <div class="form-group">
                                    <label for="grade">Module</label>
                                    <input type="file" class="form-control" name="module_path" />
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
