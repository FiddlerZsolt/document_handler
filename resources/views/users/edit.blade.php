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
        <div class="col-12 col-sm-7">
            <h2>Felhasználó szerkesztése</h2>
        </div>
        <div class="col-12 col-sm-1 d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('users.index') }}">
                <i class="bi bi-caret-left-fill"></i>
                Vissza
            </a>
        </div>
    </div>

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-4">
            <div class="form-group mb-3">
                <strong>Név:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Email:</strong>
                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Jelszó:</strong>
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Jelszó mégegyszer:</strong>
                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group mb-3">
                <strong>Rang:</strong>
                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary">
                Mentés
                &nbsp;
                <i class="bi bi-check-lg"></i>
            </button>
        </div>
        <div class="col-xs-12 col-4">
            <table class="table w-100">
                <thead>
                    <tr>
                        <th scope="col">Kategória</th>
                        <th scope="col" class="text-center">Feltöltés</th>
                        <th scope="col" class="text-center">Letöltés</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->title }}</th>
                            <td class="text-center">
                                {{ Form::checkbox(
                                    'uploadPermissions[]',
                                    $category->id,
                                    isset($preparedCategoryPermissions[$category->id]) && $preparedCategoryPermissions[$category->id]['upload'] === 1
                                        ? true
                                        : false,
                                    ['class' => 'name'],
                                ) }}
                            </td>
                            <td class="text-center">
                                {{ Form::checkbox(
                                    'downloadPermissions[]',
                                    $category->id,
                                    isset($preparedCategoryPermissions[$category->id]) && $preparedCategoryPermissions[$category->id]['download'] === 1
                                        ? true
                                        : false,
                                    ['class' => 'name'],
                                ) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
