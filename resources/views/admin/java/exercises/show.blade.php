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
                                <label for="name">Topic Id</label>
                                <input id="topicid" type="text" value="{{ $exercise->name }}" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <label for="name">Topic Name</label>
                                <input id="name" type="text" value="{{ $exercise->grade }}" class="form-control"
                                       disabled/>
                            </div>
                            <div class="form-group">
                                <label for="name">Module Path</label>
                                @if($exercise->module_path)
                                    <a class="btn btn-success form-control"
                                       href="{{url('storage' . DIRECTORY_SEPARATOR . strstr($exercise->module_path, 'java'))}}">Download</a>
                                @else
                                    <p class="form-control">No file found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.java.exercise.index') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
