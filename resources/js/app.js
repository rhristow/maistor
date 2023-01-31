import { createApp } from 'vue/dist/vue.esm-bundler.js'
import axios from 'axios'
import VueAxios from 'vue-axios'
import './utils/validation_rules'
import { successNotification, errorNotification } from '@/utils/notifications'
import { hideModal, showModal } from '@/utils/globals'

const app = createApp({})

// ========= IMPORT COMPONENTS =========
const components = import.meta.globEager('./**/*.vue')
Object.entries(components).forEach(([path, definition]) => {
    const componentName = path
        .split('/')
        .pop()
        .replace(/\.\w+$/, '')
    app.component(componentName, definition.default)
})
// ========= END IMPORT COMPONENTS =========

app.use(VueAxios, axios)
app.config.globalProperties.$successNotification = (message) => successNotification(message)
app.config.globalProperties.$errorNotification = (message) => errorNotification(message)
app.config.globalProperties.$hideModal = (id) => hideModal(id)
app.config.globalProperties.$showModal = (id) => showModal(id)

app.mount('#kt_body')
