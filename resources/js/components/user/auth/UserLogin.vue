<script>
import { Field, Form, ErrorMessage } from 'vee-validate'

export default {
    components: { Field, Form, ErrorMessage },
    data() {
        return {
            loading: false,
            details: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login() {
            this.loading = true
            this.axios.post('/user/login', this.details).then((response) => {
                if (response.data.success) {
                    window.location = '/dashboard'
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
    <Form @submit="login" class="form w-100">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Login</h1>
        </div>
        <div class="fv-row mb-8">
            <label for="email" class="required form-label"> E-mail </label>
            <Field v-model="details.email" rules="required|email" type="email" placeholder="Email" name="email" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="email"></ErrorMessage>
        </div>
        <div class="fv-row mb-3">
            <label for="password" class="required form-label"> Password </label>
            <Field v-model="details.password" rules="required" type="password" placeholder="Password" name="password" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="password"></ErrorMessage>
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <a href="/forgotten-password" class="link-primary">Forgot Password ?</a>
        </div>
        <div class="d-grid mb-10">
            <action-button class="btn btn-primary" type="submit" :loading="loading"> Login </action-button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Not a Member yet?
            <a href="/register" class="link-primary"> Register </a>
        </div>
    </Form>
</template>
