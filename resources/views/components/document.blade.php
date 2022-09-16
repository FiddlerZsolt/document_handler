@props([
    'id' => null,
    'name' => "",
    'version' => 0,
    'download'
])

<div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 documents">
    <div class="card mb-3">
        <div class="card-body pt-3">
            <h5 class="card-title text-center" style="font-size: 3rem">
                <i class="bi bi-file-earmark position-relative">
                    <span class="position-absolute top-0 start-0 translate-middle-x badge bg-danger" style="font-size: .7rem">
                        v{{ $version }}
                    </span>
                </i>
            </h5>
            <p class="card-text text-center">{{ $name }}</p>
        </div>
        <div class="card-body p-0">
            <div class="btn-group d-flex" role="group">

                {!! Form::open(['method' => 'GET', 'route' => ['file.download.index', $id], 'style' => 'display:inline', 'class' => 'w-100']) !!}
                    <button class="btn btn-outline-primary w-100 rounded-0 {{ $download ? '' : "disabled" }}">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    </button>
                {!! Form::close() !!}

                {!! Form::open(['method' => 'DELETE', 'route' => ['files.destroy', $id], 'style' => 'display:inline']) !!}
                    <button type="submit" class="btn btn-outline-danger rounded-0">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
