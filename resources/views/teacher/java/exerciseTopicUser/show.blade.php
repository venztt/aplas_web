@extends('teacher/home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">JUnit Student Result Detail</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th style="width: 40%">Name</th>
                                    <td style="width: 60%"></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Grade</th>
                                    <td style="width: 60%"></td>
                                </tr>
                                <tr>
                                    <th style="width: 40%">Module</th>
                                    <td style="width: 60%"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Result Topics</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable-exerciseTopicUser">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 2%"></th>
                                    <th style="width: 4%">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>File Path</th>
                                    <th>Test Path</th>
                                    <th>Java Exercise</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
