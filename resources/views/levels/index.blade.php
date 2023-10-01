@extends('layouts.app')

@section('title', 'Home Level')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Levels</h1>
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
        </tr>
        </thead>
        <tbody>
        @if($level->count() > 0)
            @foreach($level as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->name }}</td>
                    <td class="align-middle">{{ $rs->description }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <!-- Separate the skills button with some margin for clarity -->
                            <a href="{{ route('skills', ['id' => $rs->id]) }}" type="button" class="btn btn-primary ml-3">Skills &rarr;</a>
                        </div>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">Levels not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
