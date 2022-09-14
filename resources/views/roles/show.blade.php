@extends('layouts.app')


@section('content')
<div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-3 margin-tb mb-3">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Vissza</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group mb-3">
                <strong>Név:</strong>
                {{ $role->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Permissions:</strong>
                @if (!empty($rolePermissions))
                    @foreach ($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
