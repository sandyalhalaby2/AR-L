@extends('layouts.app')

@section('title', 'Edit Lesson')

@section('contents')
    <h1 class="mb-0">Edit Lesson</h1>
    <hr />
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" required class="form-control" placeholder="Name" value="{{ $lesson->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Language</label>
                <input type="text" name="content" required class="form-control" placeholder="Content" value="{{ $lesson->content }}" >
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end"> <!-- Added d-flex and justify-content-end classes -->
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
