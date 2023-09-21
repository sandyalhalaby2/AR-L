@extends('layouts.app')

@section('title', 'Create Course')

@section('contents')
    <h1 class="mb-0">Add Course</h1>
    <hr />
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col">
                <input type="text" name="language" class="form-control" placeholder="Language" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="level" class="form-control" placeholder="Level" pattern="\d+" required>
            </div>
            <div class="col">
                <textarea class="form-control" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
