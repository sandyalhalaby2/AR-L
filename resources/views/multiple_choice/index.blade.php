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

        @foreach(['1', '2', '3', '4', '5'] as $num)
            <div class="row mb-3">
                <div class="col">
                    <label>Option {{ $num }}:</label>
                    <div class="border p-2">
                        {{ json_decode($details->{'option_'.$num})->text ?? '' }}
                        @if(isset(json_decode($details->{'option_'.$num})->images))
                            @foreach(json_decode($details->{'option_'.$num})->images as $imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Option {{ $num }} Image" style="max-width: 100px;">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row mb-3">
            <div class="col">
                <label>Correct Answer:</label>
                <div class="border p-2">{{ $details->isCorrect }}</div>
            </div>
        </div>
    </div>
@endsection
