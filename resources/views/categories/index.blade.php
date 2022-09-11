@extends('layouts.app')


@section('content')

    @if (count($categories) > 0)
        <x-category-list :categories="$categories" />
    @else
        <ul>
            <li>Nincs megjeleníthetõ kategória</li>
        </ul>
    @endif

@endsection
