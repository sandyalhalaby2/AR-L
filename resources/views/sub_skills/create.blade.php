@extends('layouts.app')

@section('title', 'Create Sub SKill')

@section('contents')
    <h1 class="mb-0">Add Sub Skill</h1>
    <hr />
    <form action="{{ route('sub_skills.store', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" required name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <input type="text"  required name="description" class="form-control" placeholder="Description">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
