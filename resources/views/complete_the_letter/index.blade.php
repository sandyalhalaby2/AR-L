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

    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Question</h2>
            </div>
            <div class="card-body">
                <p>{{ $data->question }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h2>Sentence with Blank</h2>
            </div>
            <div class="card-body">
                <p>{{ $data->sentence_with_blank }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h2>Selected Letters</h2>
            </div>
            <div class="card-body">
                <div class="arabic-letters">
                    {{$data->letters}}
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h2>Sorted Letters</h2>
            </div>
            <div class="card-body">
                <p>{{ $data->sorted_letters }}</p>
            </div>
        </div>
    </div>
@endsection
