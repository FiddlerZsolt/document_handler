@props([
    'files'
])

<div class="row justify-content-start">

    @foreach ($files as $file)
        <x-document :name="$file->name" :version="$file->version" :link="$file->path" :id="$file->id" />
    @endforeach

</div>
