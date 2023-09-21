@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Fill in the Blank Question</h1>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <!-- Fill In the Blanks Fields -->
    <div id="fillInTheBlanksFields">
        <div class="row mb-3">
            <div class="col">
                <label for="question">Question:</label>
                <div class="border p-2">{{ $details->question }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="sentence_with_blank">Sentence with blank:</label>
                <div class="border p-2">{{ $details->sentence_with_blank }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="correct_answer">Correct Answer:</label>
                <div class="border p-2">{{ $details->correct_answer }}</div>
            </div>
        </div>
    </div>
@endsection
