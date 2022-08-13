@extends('student/home')

@section('style')
    <link rel="stylesheet" href="{{ asset('codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('codemirror/theme/duotone-dark.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h2>Advanced Form</h2>
                            <h5>Advanced Form</h5>
                        </div>
                    </div>
                    @if (session()->has('message'))
                        <div id="alert-msg" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                This page has been enhanced for printing. Click the print button at the bottom of the
                                invoice to
                                test.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mt-2">
                            <div class="btn-right">
                                <button type="button" class="btn btn-outline-primary">List Percobaan</button>
                                <button type="button" class="btn btn-outline-primary ml-2">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="btn-right float-right">
                                <button type="button" class="btn btn-primary"><i class="fas fa-heart"></i> Feedback
                                </button>
                                <button type="button" class="btn btn-success btn-validate ml-2">Validate</button>
                                <button type="button" class="btn btn-outline-primary ml-2">Sebelumnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <iframe
                                src="{{ asset('pdfjs/web/viewer.html')}}?file={{ asset('Soal Praktek Mobile 2022.pdf')}}"
                                width="100%"
                                height="700px"
                                style="border: none;"></iframe>
                        </div>
                        <div class="col-md-6 editor-container">
                            <textarea id="editor" style="visibility: hidden">// code goes here</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('codemirror/mode/clike/clike.js') }}"></script>
    <script src="{{ asset('js/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('js/task.js') }}"></script>

@endsection
