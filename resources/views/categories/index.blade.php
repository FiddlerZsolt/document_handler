@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (count($categories) > 0)
                <x-category-list :categories="$categories" />
            @else
                <ul>
                    <li>Nincs megjeleníthetõ kategória</li>
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection
