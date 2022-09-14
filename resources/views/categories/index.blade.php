@extends('layouts.app')

@push('scripts')
    <script src="/js/categories.js"></script>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-12 col-sm-12col-md-6 col-lg-5 col-xl-4 col-xxl-3 border-end">

                <div class="row justify-content-center mb-3">
                    <div class="col-12">
                        <h3 class="text-center">Kategóriák</h3>
                    </div>
                </div>

                @if ($message = session('success'))
                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @can('category-create')
                    <div class="row mb-3">
                        <div class="col-12">
                            <!-- Create new category -->
                            <button class="btn btn-success d-inline-block" type="button" data-id=""
                                data-bs-toggle="modal" data-bs-target="#new-category-modal">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                @endcan

                <div class="row justify-content-center mb-3">
                    <div class="col-12">
                        @can('category-list')
                            @if (count($categories) > 0)
                                <x-categories.list :categories="$categories" />
                            @else
                                <ul>
                                    <li>Nincs megjeleníthetõ kategória</li>
                                </ul>
                            @endif
                        @endcan
                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-12col-md-6 col-lg-7 col-xl-8 col-xxl-9">

                <div class="row justify-content-center mb-3">
                    <div class="col-12">
                        <h3 class="text-center">Fájlok</h3>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <!-- Create new category -->
                        <button class="btn btn-success d-inline-block" type="button"
                            data-bs-toggle="modal" data-bs-target="#upload-modal">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>

                <x-documents />

            </div>

        </div>
    </div>

    <x-modals.upload />

    <x-modals.create />

    <x-modals.edit />

    <x-modals.delete />

@endsection
