@props([
    'id' => null,
    'name' => "",
    'version' => 0,
    'download'
])


<li class="list-group-item list-group-item-action">
    <div class="d-flex align-items-center justify-content-start">

        <div class="me-3">
            <h5 class="card-title text-center" style="font-size: 3rem">
                <i class="bi bi-file-earmark position-relative">
                    <span class="position-absolute top-0 start-0 translate-middle-x badge bg-danger" style="font-size: .7rem">
                        v{{ $version }}
                    </span>
                </i>
            </h5>
        </div>

        <div class="w-100">
            <p class="card-text text-center fs-2">{{ $name }}</p>
        </div>

        <div class="ms-3">
            <div class="btn-group" role="group">
                {!! Form::open(['method' => 'GET', 'route' => ['file.download.index', $id]]) !!}
                    <button class="btn btn-outline-primary me-3 fs-4 {{ $download ? '' : "disabled" }}" title="letöltés">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    </button>
                {!! Form::close() !!}

                {!! Form::open(['method' => 'DELETE', 'route' => ['files.destroy', $id]]) !!}
                    <button type="submit" class="btn btn-outline-danger fs-4">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</li>
