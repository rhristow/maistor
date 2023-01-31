export function successNotification(message = 'Success') {
    Swal.fire({ icon: 'success', title: message, toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, width: '15rem' })
}

export function errorNotification(message = 'Something went wrong. Please, try again later.') {
    Swal.fire({ title: 'Error', text: message, icon: 'error', buttonsStyling: false, customClass: { confirmButton: 'btn btn-danger' }, heightAuto: false })
}
