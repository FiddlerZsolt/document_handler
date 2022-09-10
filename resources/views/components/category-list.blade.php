@props([
    'categories'
])

<ul id="category-list">

    @foreach ($categories as $category)

        <x-category-item :category="$category" :except="1" />

    @endforeach

</ul>
