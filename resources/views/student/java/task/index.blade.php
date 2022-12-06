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
                        <div class="col-sm-12">
                            <h2>{{ $javaExerciseTopic->name }}</h2>
                            {{ $javaExerciseTopic->description }}
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
                                Sebelum mengerjakan task ini, pastikanlah sudah membaca modul dan dokumentasi yang sudah di berikan.
                                Kerjakan sesuai dengan arahan
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mt-2">
                            <div class="btn-right">
                                <a href="{{ route('student.java.exercise.show', $javaExercise->id) }}"
                                   class="btn btn-outline-primary">List Percobaan</a>
                                @if($previousTopic)
                                    <a href="{{route('student.java.exercise.doTask', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $previousTopic->id]) }}"
                                       class="btn btn-outline-primary ml-2">Sebelumnya</a>
                                @else
                                    <button type="button" disabled
                                            class="btn btn-outline-primary ml-2">Sebelumnya
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="btn-right float-right">
                                @if(!$nextTopic)
                                    <a href="{{ route('student.java.learning-result.feedback', ['javaExercise' => $javaExercise->id]) }}" class="btn btn-primary">Feedback</a>
                                @endif
                                <button type="button"
                                        class="btn btn-success btn-validate ml-2" {{ $validationHistoryPass ? 'disabled' : '' }}>{{ $validationHistoryPass ? 'Passed': 'Koreksi'}}</button>
                                @if($nextTopic)
                                    <a href="{{route('student.java.exercise.doTask', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $nextTopic->id]) }}"
                                       class="btn btn-outline-primary ml-2">Selanjutnya</a>
                                @else
                                    <button type="button" disabled
                                            class="btn btn-outline-primary ml-2">Selanjutnya
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <iframe
                                src="{{ asset('pdfjs/web/viewer.html')}}?file={{ asset('stream.pdf')}}"
                                width="100%"
                                height="700px"
                                style="border: none;"></iframe>
                        </div>
                        <div class="col-md-6 editor-container">
                            <textarea id="editor" style="visibility: hidden">{{ $codeTemplate ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <h5>Riwayat Validasi</h5>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover datatable-taskHistory">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 4%">ID</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($validationHistory->count() > 0)
                                    @foreach($validationHistory as $items)
                                        <tr>
                                            <td>{{$items->id ?? ''}}</td>
                                            <td>{{$items->raw ?? ''}}</td>
                                            <td>{{$items->status ?? ''}}</td>
                                            <td>{{$items->report ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center no-history" colspan="5">No history to show</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const global = {
            doTask: '{{ route('student.java.exercise.execute', ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $javaExerciseTopic->id]) }}'
        };
    </script>
    <script src="{{ asset('codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('codemirror/mode/clike/clike.js') }}"></script>
    <script src="{{ asset('js/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('js/task.js') }}"></script>
@endsection
