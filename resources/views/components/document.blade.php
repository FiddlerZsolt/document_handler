@props(['file', 'download'])

<tr>
    <th scope="col">
        <h5 class="card-title text-center" style="font-size: 3rem">
            <i class="bi bi-file-earmark position-relative">
                <span class="position-absolute top-0 start-0 translate-middle-x badge bg-danger" style="font-size: .7rem">
                    v{{ $file->version }}
                </span>
            </i>
        </h5>
    </th>
    <th scope="col">
        <p class="card-text text-center fs-2">{{ $file->name }}</p>
    </th>
    <th scope="col">
        <p class="card-text text-center fs-2">{{ $file->created_at }}</p>
    </th>
    <th scope="col">
        <p class="card-text text-center fs-2">{{ $file->user_name }}</p>
    </th>
    <th scope="col">
        <div class="btn-group" role="group">
            {!! Form::open(['method' => 'GET', 'route' => ['file.download.index', $file->id]]) !!}
            <button class="btn btn-outline-primary me-3 fs-4 {{ $download ? '' : 'disabled' }}" title="letöltés">
                <i class="bi bi-file-earmark-arrow-down-fill"></i>
            </button>
            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'route' => ['files.destroy', $file->id]]) !!}
            <button type="submit" class="btn btn-outline-danger fs-4">
                <i class="bi bi-trash3-fill"></i>
            </button>
            {!! Form::close() !!}
        </div>
    </th>
</tr>
