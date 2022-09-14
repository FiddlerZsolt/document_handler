<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="Delete modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Biztosan törlöd a kategóriát?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete-form" class="d-flex justify-content-end" action="{{ route('categories.destroy', 0) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">
                        Törlés
                        &nbsp;
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                </div>
            </form>
        </div>
    </div>
</div>
