@props(['categories', 'active_category'])

<div class="accordion" id="categories">
    @foreach ($categories as $category)
        <x-categories.item :category="$category" :active_category="$active_category" />
    @endforeach
</div>
