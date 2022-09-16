@props(['message', 'type' => 'error'])

@php
if ($type === 'error') {
    $className = 'danger';
}
if ($type === 'success') {
    $className = 'success';
}
@endphp

<div class="alert alert-{{ $className }} alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
