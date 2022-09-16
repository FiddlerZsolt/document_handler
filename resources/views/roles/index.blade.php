@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="row justify-content-center mb-3">
            <div class="col-md-5">
                <x-alert :message="$message" type="success" />
            </div>
        </div>
    @endif
    <div class="row justify-content-center mb-3">
        <div class="col-md-5 margin-tb">
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-5 margin-tb">

            <table class="table table-bordered">
                <tr>
                    <th colspan="2">Név</th>
                </tr>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td class="border-end-0" style="height: 1px">
                            <div class="d-flex align-items-center h-100">
                                {{ $role->name }}
                            </div>
                        </td>
                        <td class="border-start-0 w-25">
                            <div class="d-flex justify-content-end">
                                @can('role-edit')
                                    <a class="btn btn-sm btn-primary" href="{{ route('roles.edit', $role->id) }}">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                        <button type="submit" class="btn btn-sm btn-danger ms-2">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    {!! Form::close() !!}
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>

{!! $roles->render() !!}

@endsection
