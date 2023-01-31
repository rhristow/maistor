<script>
import { Field, Form, ErrorMessage } from 'vee-validate'

export default {
    components: { Field, Form, ErrorMessage },
    data () {
        return {
            loading: false,
            details: {
                email: '',
                name: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        register () {
            this.loading = true
            this.axios.post('/user/register', this.details).then((response) => {
                if (response.data.success) {
                    window.location = '/login'
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
    <Form @submit="register()" class="form w-100">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Register</h1>
        </div>
        <div class="fv-row mb-8">
            <label for="email" class="required form-label"> E-mail </label>
            <Field v-model="details.email" rules="required|email" type="email" placeholder="Email" name="email" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="email"></ErrorMessage>
        </div>
        <div class="fv-row mb-8">
            <label for="name" class="required form-label"> Name </label>
            <Field v-model="details.name" rules="required" type="text" placeholder="Your Name" name="name" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="name"></ErrorMessage>
        </div>
        <div class="fv-row mb-8">
            <label for="password" class="required form-label"> Password </label>
            <Field v-model="details.password" rules="required|min:6" type="password" placeholder="Password" name="password" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="password"></ErrorMessage>
        </div>
        <div class="fv-row mb-8">
            <label for="password_confirmation" class="required form-label">Confirm Password </label>
            <Field v-model="details.password_confirmation" rules="required|confirmed:@password" type="password" placeholder="Confirm Your Password" name="password_confirmation" class="form-control bg-transparent" />
            <ErrorMessage class="text-danger ms-1" name="password_confirmation"></ErrorMessage>
        </div>
        <div class="d-grid mb-10">
            <action-button class="btn btn-primary" type="submit" :loading="loading"> Register </action-button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an account?
            <a href="/login" class="link-primary"> Login </a>
        </div>
    </Form>
</template>
