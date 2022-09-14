@props(['categories'])

<div class="accordion" id="categories">
    @foreach ($categories as $category)
        <x-categories.item :category="$category" :except="1" />
    @endforeach
</div>
