@extends('layouts.app')

@section('title', 'Home Skill')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Skills</h1>
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
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @if($skills->count() > 0)
            @foreach($skills as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->type }}</td>
                    <td class="align-middle">{{ $rs->description }}</td>

                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            </div>
                            <!-- Separate the skills button with some margin for clarity -->
                            <a href="{{ route('sub_skills', ['id' => $rs->id]) }}" type="button" class="btn btn-primary ml-3">Sub_Skills &rarr;</a>
                        </div>
                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">Skill not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
