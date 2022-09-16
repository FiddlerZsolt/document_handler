@props([
    'message',
    'type' => "error"
])

@if ($type === "error")
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
@endif

@if ($type === "success")
    <div class="alert alert-success alert-dismissible fade show" role="alert">
@endif

    {{ $message }}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
