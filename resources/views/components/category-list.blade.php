@props(['categories'])

<div id="category-list" class="list-group">

    @foreach ($categories as $category)
        <x-category-item :category="$category" :except="1" />
    @endforeach

</div>
