@props(['category', 'selected' => 1, 'except' => null])

@if ($except != $category->id)

    <option value="{{ $category->id }}" {{ $selected === $category->id ? 'selected' : '' }}>

        {{ $category->title === 'main' ? 'Válassz' : $category->title }}

        @foreach ($category->children as $child)
            <x-categories.option :category="$child" :selected="$selected" :except="$except" />
        @endforeach

    </option>

@endif
