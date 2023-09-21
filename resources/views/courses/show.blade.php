@extends('layouts.app')

@section('title', 'Show Course')

@section('contents')
    <h1 class="mb-0">Detail Course</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $course->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Language</label>
            <input type="text" name="language" class="form-control" placeholder="Language" value="{{ $course->language }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Level</label>
            <input type="text" name="level" class="form-control" placeholder="Level" value="{{ $course->level }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Description" readonly>{{ $course->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $course->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $course->updated_at }}" readonly>
        </div>
    </div>
@endsection
