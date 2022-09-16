<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal">Kategória szerkesztése</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" action="{{ url('categories') }}" data-base="{{ url('categories') }}">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">
                                    Kategória neve
                                </label>
                                <input type="text" id="name" class="form-control" name="title" value="">
                                <div id="nameHelp" class="form-text">
                                    Minimum 3 karakter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Mentés
                        &nbsp;
                        <i class="bi bi-check-lg"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                </div>
            </form>
        </div>
    </div>
</div>
