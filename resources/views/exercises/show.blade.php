@extends('layouts.app')

@section('title', 'Show Exercise')

@section('contents')
    <h1 class="mb-0">Detail Exercise</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" placeholder="Type" value="{{ $exercise->type }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Content</label>
            <input type="text" name="content" class="form-control" placeholder="Content" value="{{ $exercise->content }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $exercise->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $exercise->updated_at }}" readonly>
        </div>
    </div>

    @if($exercise->image_link)
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Image</label>
                <img src="{{asset($exercise->image_link) }}" alt="Exercise Image" class="img-fluid">
            </div>
        </div>
    @endif

    @if($exercise->audio_link)
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Audio</label>
                <audio controls>
                    <source src="{{ asset('storage/app/public/'.$exercise->audio_link) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    @endif
@endsection
