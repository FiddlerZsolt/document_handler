<!-- Create Modal -->
<div class="modal fade" id="new-category-modal" tabindex="-1" aria-labelledby="edit modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-category-modal">Új kategória</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" id="create-form">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">
                                    Kategória neve
                                </label>
                                <input type="text" id="name" class="form-control" name="title" value="">
                                <input type="hidden" id="parent_id" class="form-control" name="parent_id" value="">
                                <div id="nameHelp" class="form-text">
                                    Minimum 3 karakter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Létrehozás
                        &nbsp;
                        <i class="bi bi-plus-circle-fill"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                </div>
            </form>
        </div>
    </div>
</div>
