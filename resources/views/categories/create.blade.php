@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('categories.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Kategória neve</label>
                        <input type="text" class="form-control" id="name" name="title">
                        <div id="emailHelp" class="form-text">Minimum 3 karakter</div>
                    </div>

                    <x-category-select :categories="$categories" name="parent_id" />

                    <button type="submit" class="btn btn-primary">
                        Létrehozás
                        &nbsp;
                        <i class="bi bi-plus-circle-fill"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
