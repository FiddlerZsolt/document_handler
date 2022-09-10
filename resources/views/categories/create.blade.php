@extends('layouts.app')


@section('content')

    <form action="/categories/store" method="POST">

        @csrf

        <table>

            <tr>
                <td>
                    <input type="text" name="title" placeholder="Kategória neve">
                </td>
            </tr>

            <tr>
                <td>
                    <x-category-select :categories="$categories" name="parent_id" />
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Küldés">
                </td>
            </tr>

        </table>
    </form>

@endsection
