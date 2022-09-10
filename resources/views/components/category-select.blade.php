@props([
    'categories',
    'name' => '',
    'selected' => 1,
    'except' => null
])

<select name="{{ $name }}">

    @foreach ($categories as $category)

        <x-category-option :category="$category" :selected="$selected" :except="$except" />

    @endforeach

</select>
