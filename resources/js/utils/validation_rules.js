import { defineRule, configure } from 'vee-validate'
import { required, email, min, max, confirmed, min_value } from '@vee-validate/rules'
import { localize } from '@vee-validate/i18n'

defineRule('required', required)
defineRule('email', email)
defineRule('min', min)
defineRule('max', max)
defineRule('confirmed', confirmed)
defineRule('min_value', min_value)

configure({ generateMessage: localize('en', { messages: { required: 'This field is required' } }) })
configure({ generateMessage: localize('en', { messages: { email: 'Invalid e-mail address' } }) })
configure({ generateMessage: localize('en', { messages: { confirmed: 'Passwords do not match' } }) })
configure({ generateMessage: localize('en', { messages: { min: 'This field must be at least {0} characters' } }) })
configure({ generateMessage: localize('en', { messages: { max: 'This field cannot have more than {0} characters' } }) })
configure({ generateMessage: localize('en', { messages: { min_value: 'This field must be minimum {0}' } }) })
