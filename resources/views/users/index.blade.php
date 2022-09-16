@extends('layouts.app')


@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center mb-3">
            <div class="col-md-8 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Név</th>
                            <th scope="col">Email</th>
                            <th scope="col" colspan="2">Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td style="height: 1px">
                                    <div class="d-flex align-items-center h-100">
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td style="height: 1px">
                                    <div class="d-flex align-items-center h-100">
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="border-end-0" style="height: 1px">
                                    <div class="d-flex align-items-center h-100">
                                        @if ($user->getRoleNames())
                                            <label class="badge bg-success">{{ $user->getRoleNames()->first() }}</label>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-start-0">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}">
                                            <i class="bi bi-pen-fill"></i>
                                        </a>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                        <button type="submit" class="btn btn-sm btn-danger ms-2">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $data->render() !!}
            </div>
        </div>
    </div>
@endsection
