@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">True OR False Question</h1>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div id="true_or_false" >
        <div class="row mb-3">
            <div class="col">
                <label for="question">Question:</label>
                <div class="border p-2">{{ $details->question }}</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Correct Answer:</label>
                @if($details->is_true)
                    <div class="border p-2">True</div>
                @else
                    <div class="border p-2">False</div>
                @endif

            </div>
        </div>
    </div>
@endsection
