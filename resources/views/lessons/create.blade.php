@extends('layouts.app')

@section('title', 'Create Lesson')

@section('contents')
    <h1 class="mb-0">Add lesson</h1>
    <hr />
    <form action="{{ route('lessons.store', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" required name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <input type="text"  required name="content" class="form-control" placeholder="Content">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
