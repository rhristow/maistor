export function hideModal(id) {
    var myModalEl = document.getElementById(id)
    var modal = bootstrap.Modal.getInstance(myModalEl)
    modal.hide()
}

export function showModal(id) {
    var modal = new bootstrap.Modal(document.getElementById(id))
    modal.show()
}
