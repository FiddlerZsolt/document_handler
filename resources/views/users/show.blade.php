@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3 margin-tb mb-3">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
            <div class="form-group mb-3">
                <strong>Roles:</strong>
                @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $role)
                        <label class="badge bg-success">{{ $role }}</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
