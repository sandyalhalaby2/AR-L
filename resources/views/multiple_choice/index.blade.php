@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Multiple Choice Question</h1>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div id="multipleChoiceFields" >
        <div class="row mb-3">
            <div class="col">
                <label for="question">Question:</label>
                <div class="border p-2">{{ $details->question }}</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Option 1:</label>
                <div class="border p-2">{{ $details->option_1 }}</div>
            </div>
            <div class="col">
                <label>Option 2:</label>
                <div class="border p-2">{{ $details->option_2 }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Option 3:</label>
                <div class="border p-2">{{ $details->option_3 }}</div>
            </div>
            <div class="col">
                <label>Option 4:</label>
                <div class="border p-2">{{ $details->option_4 }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Option 5:</label>
                <div class="border p-2">{{ $details->option_5 }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Correct Answer:</label>
                <div class="border p-2">{{ $details->isCorrect }}</div>
            </div>
        </div>
    </div>
@endsection
