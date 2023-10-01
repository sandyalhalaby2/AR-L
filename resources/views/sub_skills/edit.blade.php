@extends('layouts.app')

@section('title', 'Edit Sub Skill')

@section('contents')
    <h1 class="mb-0">Edit Sub Skill</h1>
    <hr />
    <form action="{{ route('sub_skills.update', $sub_skill->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" required class="form-control" placeholder="Name" value="{{ $sub_skill->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" required class="form-control" placeholder="Content" value="{{ $sub_skill->description }}" >
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end"> <!-- Added d-flex and justify-content-end classes -->
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
