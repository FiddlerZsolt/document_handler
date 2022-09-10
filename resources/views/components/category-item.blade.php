@props([
    'category',
    'except' => 1
])

<li style="margin-left: {{ $category->depth - 1 }}rem;">
    <a href="/categories/{{ $category->id }}">

        {{ $category->title }}

        @foreach ($category->children as $child)

            <x-category-item :category="$child" :except="$except" />

        @endforeach

    </a>
</li>
