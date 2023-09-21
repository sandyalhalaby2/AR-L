@extends('layouts.app')

@section('title', 'Edit Exercise')

@section('contents')
    <h1 class="mb-0">Edit Exercise</h1>
    <hr />
    <form action="{{ route('exercises.update', $exercise->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-control" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="translation">Translation</option>
                    <option value="listening">Listening</option>
                    <option value="sentenceFormation">sentenceFormation</option>
                    <option value="multipleChoice">multipleChoice</option>
                </select>
            </div>
            <div class="col mb-3">
                <label class="form-label">Content</label>
                <input type="text" name="content" class="form-control" placeholder="Content" required value="{{ $exercise->content }}" >
            </div>

        </div>
        <div class="row">
            <div class="col d-flex justify-content-end"> <!-- Added d-flex and justify-content-end classes -->
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
