@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-3 mb-3">
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Vissza</a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Email:</strong>
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Password:</strong>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
