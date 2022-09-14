@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-3 mb-3">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Vissza</a>
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

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Permission:</strong>
                <br />
                @foreach ($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                        {{ $value->name }}</label>
                    <br />
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Küldés</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
