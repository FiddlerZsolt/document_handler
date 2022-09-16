@props([
    'files',
    'download'
])

<ul class="list-group">

    @foreach ($files as $file)
        <x-document :name="$file->name" :version="$file->version" :id="$file->id" :download="$download" />
    @endforeach

</ul>
