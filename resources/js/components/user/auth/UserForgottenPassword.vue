<script>
import { Field, Form, ErrorMessage } from 'vee-validate'

export default {
    components: { Field, Form, ErrorMessage },
    data() {
        return {
            loading: false,
            details: {
                email: '',
                newPassword: '',
                confirmPassword: ''
            }
        }
    },
    methods: {
        submitForgottenPassword() {
            this.loading = true
            this.axios.post('/user/submitForgottenPassword', this.details).then((response) => {
                if (response.data.success) {
                    Swal.fire({
                        html: 'If there is an account with this e-mail address, you will receive instructions on changing your password.',
                        icon: 'success',
                        heightAuto: false,
                        buttonsStyling: false,
                        customClass: { confirmButton: 'btn btn-success' },
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    }).then((result) => {
                        window.location = '/login'
                    })
                } else {
                    this.$errorNotification(response.data.message)
                    this.loading = false
                }
            })
        }
    }
}
</script>

<template>
    <Form @submit="submitForgottenPassword" class="form w-100">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Forgotten password</h1>
        </div>
        <div class="fv-row mb-8">
            <label for="email" class="required form-label"> E-mail </label>
            <Field v-model="details.email" rules="required|email" type="email" placeholder="Email" name="email" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="email"></ErrorMessage>
        </div>
        <div class="d-grid mb-10">
            <action-button class="btn btn-primary" type="submit" :loading="loading"> Send </action-button>
            <a href="/login"> back </a>
        </div>
    </Form>
</template>
