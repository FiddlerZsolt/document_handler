@props([
    'files',
    'download'
])

<div class="row justify-content-start">

    @foreach ($files as $file)
        <x-document :name="$file->name" :version="$file->version" :id="$file->id" :download="$download" />
    @endforeach

</div>
