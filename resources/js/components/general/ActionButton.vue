<script>
export default {
    props: ['type', 'loading']
}
</script>

<template>
    <button :type="type" :disabled="loading">
        <span v-if="!loading">
            <slot></slot>
        </span>
        <span v-else>
            <span> Please wait... </span>
            <div class="spinner-border spinner-border-sm align-middle ms-2">
                <span class="visually-hidden"> Loading... </span>
            </div>
        </span>
    </button>
</template>

<style scoped></style>
