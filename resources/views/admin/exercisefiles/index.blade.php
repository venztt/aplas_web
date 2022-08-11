@extends('admin/admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Android Programming Exercise Files</h3>
                <div class="card-tools">
                    <a href="{{ URL::to('/admin/exercisefiles/create')}}" class="btn btn-tool">
                        <i class="fa fa-plus"></i>
                        &nbsp; Add
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('message'))
                <div id="alert-msg" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                    {{ Session::get('message') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Topic Name</th>
                                    <th>Guide Document</th>
                                    <th>Test File(s)</th>
                                    <th>Supplement File(s)</th>
                                    <th>Other File(s)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entities as $entity)
                                <tr>
                                    <td>{{ $entity['name'] }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="{{ URL::to('/download/exerciseguide/'.str_replace('exercise_files/','',$entity['guide']).'/'.str_replace(' ','',$entity['name'])) }}"><i class="fa fa-download"></i>&nbsp;Download</a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="{{ URL::to('/download/exercisetest/'.str_replace('exercise_files/','',$entity['testfile']).'/'.str_replace(' ','',$entity['name'])) }}"><i class="fa fa-download"></i>&nbsp;Download</a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="{{ URL::to('/download/exercisesupp/'.str_replace('exercise_files/','',$entity['supplement']).'/'.str_replace(' ','',$entity['name'])) }}"><i class="fa fa-download"></i>&nbsp;Download</a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @if($entity['other'] !='')
                                            <a class="btn btn-info" href="{{ URL::to('/download/exerciseother/'.str_replace('exercise_files/','',$entity['other']).'/'.str_replace(' ','',$entity['name'])) }}"><i class="fa fa-download"></i>&nbsp;Download</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ URL::to('/admin/exercisefiles/'.$entity['id']) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <div class="btn-group">
                                                <a class="btn btn-success" href="{{ URL::to('/admin/exercisefiles/'.$entity['id'].'/edit') }}"><i class="fa fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="form-group">
                    <label for="description">How to Use</label>
                    <textarea id="howto" class="form-control" disabled rows="5">
1. Download guide, test, supplement, and other file for a learning topic.
2. Use Guide document to start and develop the Android project.
3. Use the necessary files in supplement folder to develop the Android project
4. After finished the project, use the test files in test folder validate the project.
                </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
