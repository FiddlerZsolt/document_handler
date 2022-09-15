document.addEventListener("DOMContentLoaded", function() {
    const createButtons = document.querySelectorAll('[data-bs-target="#new-category-modal"]')
    const editButtons = document.querySelectorAll('[data-bs-target="#edit-modal"]')
    const deleteButtons = document.querySelectorAll('[data-bs-target="#delete-modal"]')

    const createModal = document.getElementById('new-category-modal')
    const editModal = document.getElementById('edit-modal')

    collapseSelectedCategoryParents()

    createModal.addEventListener('hidden.bs.modal', function(event) {
        this.querySelector(`input[name="title"]`).value = ''
        this.querySelector(`input[name="parent_id"]`).value = ''
    })

    editModal.addEventListener('hidden.bs.modal', function(event) {
        this.querySelector(`input[name="title"]`).value = ''
    })

    createButtons.forEach((button, i) => {
        button.addEventListener('click', function() {
            createModal.querySelector(`#parent_id`).value = this.dataset.id
        })
    })

    editButtons.forEach((button, i) => {
        button.addEventListener('click', function() {
            const id = this.dataset.id
            const title = this.dataset.title
            const form = document.getElementById('edit-form')
            const input = document.querySelector('#edit-form input[name="title"]')
            form.action = `categories/${id}`
            input.value = title
            console.log(form);
        })
    })

    deleteButtons.forEach((button, i) => {
        button.addEventListener('click', function() {
            const id = this.dataset.id
            const form = document.getElementById('delete-form')
            form.action = `categories/${id}`
            console.log(form);
        })
    })
});

function collapseSelectedCategoryParents() {
    const active = document.querySelector('[data-path]')
    const path = active.dataset.path
    const parents = path.split('.')
    parents.pop();
    parents.forEach(cat => {
        document
            .getElementById(`collapse-${cat}`)
            .classList
            .add('show')
    })
}

