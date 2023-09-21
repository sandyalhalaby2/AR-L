@extends('layouts.app')

@section('title', 'Home Course')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Course</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
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
            <th>Language</th>
            <th>level</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @if($course->count() > 0)
            @foreach($course as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->name }}</td>
                    <td class="align-middle">{{ $rs->language }}</td>
                    <td class="align-middle">{{ $rs->level }}</td>
                    <td class="align-middle">{{ $rs->description }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('courses.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('courses.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('courses.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                            <!-- Separate the lessons button with some margin for clarity -->
                            <a href="{{ route('lessons', ['id' => $rs->id]) }}" type="button" class="btn btn-primary ml-3">lessons &rarr;</a>
                        </div>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">Course not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
