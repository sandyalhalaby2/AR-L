@extends('layouts.app')

@section('title', 'Home Sub Skill')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Sub Skill</h1>
        <a href="{{ route('sub_skills.create', ['id' => $id]) }}" class="btn btn-primary">Add Sub Skill</a>

    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @if($sub_skills->count() > 0)
            @foreach($sub_skills as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->name }}</td>
                    <td class="align-middle">{{ $rs->description }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('sub_skills.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('sub_skills.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('sub_skills.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>

                            <a href="{{ route('exercises', ['id' => $rs->id]) }}" type="button" class="btn btn-primary ml-3">exercise &rarr;</a>
                        </div>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">Sub Skill not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
