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
                <label class="form-label">Xp</label>
                <input type="text" class="form-control"  name="xp" placeholder="XP" pattern="\d+" required value="{{$exercise->xp}}">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Content</label>
                <textarea type="text" name="content" class="form-control" placeholder="Content" required >{{$exercise->content}}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end"> <!-- Added d-flex and justify-content-end classes -->
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
