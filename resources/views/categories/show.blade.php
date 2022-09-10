@extends('layouts.app')


@section('content')

    <style>
        table { border-collapse: collapse; }
        th,td { border: 1px solid black; padding: .5rem 1rem; }
    </style>

    <div class="category">

        <form action="/categories/{{ $category->id }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">
                Delete
            </button>
        </form>

        <form action="/categories/{{ $category->id }}" method="POST">
            @csrf
            <table>

                <tr>
                    <td>Név</td>
                    <td colspan="2">
                        {{ $category->title }}
                        <input type="text" name="title" {{-- style="display: none;" --}} value="{{ $category->title }}">
                    </td>
                </tr>

                <tr>
                    <td>Szülõ:</td>
                    <td {{ $category->parent_id === 1 ? "colspan=2" : ""}}>
                        <x-category-select
                            name="parent_id"
                            :categories="$categories"
                            :selected="$category->parent_id"
                            :except="$category->id" />
                    </td>
                    @if ($category->parent_id != 1)
                        <td>
                            <a href="/categories/{{ $category->parent_id }}">
                                See
                            </a>
                        </td>
                    @endif
                </tr>

                @if ($children)
                    <tr>
                        <td>Gyerekek</td>
                        <td colspan="2">
                            <x-category-list :categories="$children" />
                        </td>
                    </tr>
                @endif

                <tr>
                    <td colspan="2"></td>
                    <td>
                        <button type="submit">
                            Save
                        </button>
                    </td>
                </tr>

            </table>
        </form>

    </div>

@endsection
