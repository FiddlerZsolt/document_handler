@props(['files', 'download'])

<table class="table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col" class="text-center fs-4">Név</th>
            <th scope="col" class="text-center fs-4">Feltöltés dátuma</th>
            <th scope="col" class="text-center fs-4">Feltöltő</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        @if (count($files) > 0)
            @foreach ($files as $file)
                <x-document :file="$file" :download="$download" />
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center fs-3">Nincs megjeleníthető dokumentum</td>
            </tr>
        @endif
    </tbody>
</table>
