@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Match The Pairs Question</h1>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div id="matchThePairsFields">
        <div class="row mb-3">
            <div class="col">
                <label for="question_fill2">Question:</label>
                <div class="border p-2">{{ $matchThePair->question }}</div>
            </div>
        </div>

        @for($i = 1; $i <= 5; $i++)
            <div class="row mb-3">
                <div class="col">
                    <label for="pair_{{ $i }}_item_a">Pair {{ $i }} - Item A:</label>
                    <div class="border p-2">{{ $matchThePair["pair_{$i}_item_a"] }}</div>
                </div>
                <div class="col">
                    <label for="pair_{{ $i }}_item_b">Pair {{ $i }} - Item B:</label>
                    <div class="border p-2">{{ $matchThePair["pair_{$i}_item_b"] }}</div>
                </div>
            </div>
        @endfor
    </div>
@endsection
