@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-sm-7">
                @foreach ($errors->all() as $error)
                    <x-alert :message="$error" />
                @endforeach
            </div>
        </div>
    @endif

    <div class="row justify-content-center mb-3">
        <div class="col-12 col-sm-2">
            <h2>Rang szerkesztése</h2>
        </div>
        <div class="col-12 col-sm-1 d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">
                <i class="bi bi-caret-left-fill"></i>
                Vissza
            </a>
        </div>
    </div>


    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3 mb-3">
            <div class="form-group mb-3">
                <strong>Név:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <div class="mb-1 mt-3">
                    <strong>Hozzáférés:</strong>
                </div>
                <ul class="list-group">
                    @foreach ($permission as $value)
                        <li class="list-group-item">
                            <label class="d-flex align-items-center form-check-label">
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'form-check-input me-2']) }}
                                {{ $value->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button type="submit" class="btn btn-primary">
                Mentés
                &nbsp;
                <i class="bi bi-check-lg"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
