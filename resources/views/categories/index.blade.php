@extends('layouts.app')

@push('scripts')
    <script src="/js/categories.js"></script>
@endpush

@php
    $uploadPermission = !is_null($categoryPermission) && $categoryPermission->upload;
    $downloadPermission = !is_null($categoryPermission) && $categoryPermission->download;
@endphp

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
                            <x-alert :message="$message" type="success" />
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            @foreach ($errors->all() as $error)
                                <x-alert :message="$message" />
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
                                <x-categories.list :categories="$categories" :active_category="$active_category" />
                            @else
                                <x-alert message="Nincs megjeleníthetõ kategória" type="success" />
                            @endif
                        @endcan
                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-12col-md-6 col-lg-7 col-xl-8 col-xxl-9">

                @if (!is_null($active_category))

                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            <h3 class="text-center">
                                {{ $active_category->title }}
                            </h3>
                        </div>
                    </div>

                    @if ($uploadPermission)
                        <div class="row mb-3">
                            <div class="col-12">
                                <!-- Upload new file -->
                                <button class="btn btn-success d-inline-block" type="button"
                                    data-bs-toggle="modal" data-bs-target="#upload-modal">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    <x-documents :files="$files" :download="$downloadPermission" />

                    <x-modals.upload :id="$active_category" />

                @else

                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            <h3 class="text-center">
                                Nincs kiválasztva kategóra, vagy nem létezik
                            </h3>
                        </div>
                    </div>

                @endif

            </div>

        </div>
    </div>

    <x-modals.create />

    <x-modals.edit />

    <x-modals.delete />

@endsection
