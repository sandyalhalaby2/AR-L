@extends('layouts.app')

@section('title', 'Edit Course')

@section('contents')
    <h1 class="mb-0">Edit Course</h1>
    <hr />
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ $course->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Language</label>
                <input type="text" name="language" class="form-control" placeholder="Language" required value="{{ $course->language }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Course Level</label>
                <input type="text" name="level" class="form-control" pattern="\d+" placeholder="Level" required value="{{ $course->level }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" >{{ $course->description }}</textarea>
            </div>

        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
