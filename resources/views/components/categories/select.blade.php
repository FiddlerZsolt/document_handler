@props(['categories', 'name' => '', 'selected' => 1, 'except' => null])

<select name="{{ $name }}" class="form-select mb-3">

    @foreach ($categories as $category)
        <x-categories.option :category="$category" :selected="$selected" :except="$except" />
    @endforeach

</select>
