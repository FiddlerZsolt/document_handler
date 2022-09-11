@props(['category', 'except' => 1])

<a  href="/categories/{{ $category->id }}"
    class="list-group-item list-group-item-action list-group-item-secondary {{ $category->isRoot() ? 'active' : '' }}">
    <span style="margin-left: {{ $category->depth - 1 }}rem;">
        @if (!$category->isRoot())
            <i class="bi bi-arrow-return-right"></i>
        @endif
        {{ $category->title }}

        @foreach ($category->children as $child)
            <x-category-item :category="$child" :except="$except" />
        @endforeach
    </span>
</a>
