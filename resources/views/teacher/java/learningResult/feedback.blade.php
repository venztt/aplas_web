@extends('student/home')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Feedback - {{ $javaExercise->name ?? '' }}</h1>
                    Setelah mengerjakan task yang ada didalam sistem ini, berikanlah kami feedback untuk terus
                    mengembangkan sistem ini.
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if (Session::has('message'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <form
                        action="{{ route('student.java.learning-result.feedbackPost', ['javaExercise' => $javaExercise->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                @if(!empty($errors->all()))
                                    <div class="alert alert-danger">
                                        <ul>{{ $errors->first() }}</ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="suggestions">Suggestions</label>
                                            <textarea class="form-control" name="suggestions" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adding_material">Add Topic Suggestions</label>
                                            <textarea class="form-control" name="adding_material" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="others">Others Suggestions</label>
                                            <textarea class="form-control" name="others" required></textarea>
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
        </div>
    </section>

@endsection
