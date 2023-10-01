@extends('layouts.app')

@section('title', 'Show Exercise')

@section('contents')
    <h1 class="mb-0">Detail Exercise</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Xp</label>
            <input type="text" name="xp" class="form-control" placeholder="Xp" value="{{ $exercise->xp }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Content</label>
            <textarea type="text" name="content" class="form-control" placeholder="Content"  readonly>{{ $exercise->content }}</textarea>
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

    @if($exercise->image_link != null)
        <div class="row mb-3">
            <div class="col">
                <div class="form-label">Image</div> <!-- Use div instead of label for better layout -->
                <div>
                    <img src="{{asset($exercise->image_link) }}" alt="Exercise Image" class="img-fluid">
                </div>
            </div>
        </div>
    @endif

    @if($exercise->audio_link != null)
        <div class="row mb-3">
            <div class="col">
                <div class="form-label">Audio</div> <!-- Use div instead of label for better layout -->
                <div>
                    <audio controls>
                        <source src="{{ asset($exercise->audio_link) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
        </div>
    @endif

@endsection
