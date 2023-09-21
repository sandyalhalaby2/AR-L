@extends('layouts.app')

@section('title', 'Home Lesson')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Lesson</h1>
        <a href="{{ route('lessons.create', ['id' => $id]) }}" class="btn btn-primary">Add Lesson</a>
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
            <th>Content</th>
        </tr>
        </thead>
        <tbody>
        @if($lessons->count() > 0)
            @foreach($lessons as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->name }}</td>
                    <td class="align-middle">{{ $rs->content }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('lessons.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('lessons.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('lessons.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                            <!-- Separate the lessons button with some margin for clarity -->
                            <a href="{{ route('exercises', ['id' => $rs->id]) }}" type="button" class="btn btn-primary ml-3">exercise &rarr;</a>
                        </div>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">Lesson not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
