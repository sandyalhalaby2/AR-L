@extends('layouts.app')

@section('title', 'Show Lesson')

@section('contents')
    <h1 class="mb-0">Detail Lesson</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $lesson->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Content</label>
            <textarea class="form-control" name="content" placeholder="Content" readonly>{{ $lesson->content }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $lesson->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $lesson->updated_at }}" readonly>
        </div>
    </div>
@endsection
