@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-10 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Név</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px"></th>
                    </tr>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->getRoleNames())
                                    @foreach ($user->getRoleNames() as $role)
                                        <label class="badge bg-success">{{ $role }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>

                {!! $data->render() !!}
            </div>
        </div>
    @endsection
