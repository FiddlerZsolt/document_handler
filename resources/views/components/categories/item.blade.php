@props(['category', 'active_category'])

@php
    $active = !is_null($active_category) && $active_category->id === $category->id;
@endphp

<div class="accordion-item border border-0">
    <h2 class="accordion-header p-1 fs-5" id="headingOne">

        <div class="btn-group d-flex" role="group">
            <a  class="text-start btn {{ $active ? "btn-dark active-category" : "btn-outline-dark" }} w-100"
                href="/categories/{{ $category->id }}"
                {{ $active ? "data-path=$category->path" : "" }}>

                @if (!$category->isRoot())
                    <i class="bi bi-arrow-return-right me-1"></i>
                @endif

                {{ $category->title }}
            </a>

            @can('category-create')
                <!-- Create new child category -->
                <button class="btn btn-outline-success d-inline-block" type="button" data-id="{{ $category->id }}"
                    data-bs-toggle="modal" data-bs-target="#new-category-modal">
                    <i class="bi bi-plus-lg"></i>
                </button>
            @endcan

            @can('category-edit')
                <!-- Edit category -->
                <button class="btn btn-outline-primary d-inline-block" type="button"
                    data-id="{{ $category->id }}" data-title="{{ $category->title }}"
                    data-title="collapse-{{ $category->title }}" data-bs-toggle="modal" data-bs-target="#edit-modal">
                    <i class="bi bi-pen-fill"></i>
                </button>
            @endcan

            @can('category-delete')
                <!-- Delete category -->
                <button class="btn btn-outline-danger d-inline-block" type="button" data-id="{{ $category->id }}"
                    data-bs-toggle="modal" data-bs-target="#delete-modal">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            @endcan

            <!-- Collapse children -->
            <button
                class="btn btn-outline-secondary d-inline-block text-start"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ $category->id }}"
                {{ $category->hasChildren() ? "" : "disabled" }}>
                <i class="bi bi-caret-down-fill"></i>
            </button>
        </div>
    </h2>

    @if ($category->hasChildren())
        <div id="collapse-{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">
            {{-- <div class="accordion-body pe-0 pt-0 pb-0"> --}}
            <div class="accordion-body pe-0 pt-0 pb-0" style="padding-left: .5rem;">
                @foreach ($category->children as $child)
                    <x-categories.item :category="$child" :active_category="$active_category" />
                @endforeach
            </div>
        </div>
    @endif

</div>
