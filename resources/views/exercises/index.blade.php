@extends('layouts.app')

@section('title', 'Home Exercise')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Exercise</h1>
        <a href="{{ route('exercises.create', ['id' => $id]) }}" class="btn btn-primary">Add Exercise</a>
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
            <th>Type</th>
            <th>Content</th>
            <th>XP</th>
        </tr>
        </thead>
        <tbody>+
        @if($exercises->count() > 0)
            @foreach($exercises as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->type }}</td>
                    <td class="align-middle">{{ $rs->content }}</td>
                    <td class="align-middle">{{ $rs->xp }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('exercises.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('exercises.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('exercises.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                            <!-- Separate the lessons button with some margin for clarity -->
                            <a href="{{ route('answer_details', $rs->id) }}" type="button" class="btn btn-primary ml-3">answer details  &rarr;</a>
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
