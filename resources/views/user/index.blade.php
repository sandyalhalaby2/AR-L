@extends('layouts.app')

@section('title', 'Users Admin')

@section('contents')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>permission</th>
            <th>XP</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $rs)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->user_name }}</td>
                    <td class="align-middle">{{ $rs->email }}</td>
                    <td class="align-middle">{{ $rs->phone_number }}</td>
                    <td class="align-middle">{{ $rs->permission }}</td>
                    <td class="align-middle">{{ $rs->xp }}</td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            @if($rs->permission == 'blocked')
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('users.block', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('UN Block this user ?')">
                                        @csrf
                                        <button class="btn btn-danger m-0">UnBlock</button>
                                    </form>
                                </div>
                            @else
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('users.block', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Block this user ?')">    @csrf
                                        <button class="btn btn-danger m-0">Block</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="5">User not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
