@extends('layouts.app')


@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biztosan törlöd a kategóriát?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="delete-form" class="d-flex justify-content-end" action="/categories/{{ $category->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Törlés
                            &nbsp;
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        {{-- Delete --}}
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger mb-3 delete-category" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Törlés
                    &nbsp;
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>
            <div class="col-md-3"></div>
        </div>

        {{-- Edit --}}
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/categories/{{ $category->id }}/edit" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Kategória neve
                        </label>
                        <input type="text" id="name" class="form-control" name="title"
                            value="{{ $category->title }}">
                        <div id="nameHelp" class="form-text">
                            Minimum 3 karakter
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Szülõ
                            &nbsp;

                            @if (!$category->isRoot())
                                <a href="/categories/{{ $category->parent_id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            @endif
                        </label>
                        <x-categories.select name="parent_id" :categories="$categories" :selected="$category->parent_id" :except="$category->id" />
                    </div>

                    @if ($children)
                        <div class="mb-3">
                            <label for="name" class="form-label">Gyerekek</label>
                            <x-categories.list :categories="$children" />
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success">
                        Mentés
                        &nbsp;
                        <i class="bi bi-check2"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
