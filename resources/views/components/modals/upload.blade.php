<!-- Create Modal -->
<div class="modal fade" id="upload-modal" tabindex="-1" aria-labelledby="upload modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upload-modal">Új dokumentum feltöltése</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('categories.store') }}" method="POST" id="create-form"> --}}
            <form action="{{ route('files.store') }}" method="POST" id="upload-form" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb-3">
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="file">
                                    <div id="fileTypeHelp" class="form-text">
                                        Megengedett formátumok: jpg, png, jpeg, gif, svg
                                    </div>
                                    <div id="fileSizeHelp" class="form-text">
                                        Megengedett méret: 2MB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Feltöltés
                        &nbsp;
                        <i class="bi bi-file-earmark-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                </div>
            </form>
        </div>
    </div>
</div>
