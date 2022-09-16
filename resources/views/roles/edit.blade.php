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


    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3 mb-3">
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Permission:</strong>
                <br />
                @foreach ($permission as $value)
                    <label>
                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                        {{ $value->name }}
                    </label>
                    <br />
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
