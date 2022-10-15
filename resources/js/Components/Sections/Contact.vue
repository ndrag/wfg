<template>
    <div class="section-body overflow-hidden bg-gray-100 py-16 px-4 sm:px-6 lg:px-8 lg:py-24">
        <div class="relative mx-auto max-w-xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Contact us</h2>
                <p class="mt-4 text-lg">For more information, please send us a message using the form below.</p>
            </div>

            <div class="mt-12">
                <form @submit.prevent="submitContactForm" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8"
                    :class="{ 'opacity-50' : submitted }">
                    <div>
                        <label for="first-name" class="block text-sm font-medium">First name</label>
                        <div class="mt-1">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="wfg-form-field" :disabled="submitted || form.processing" v-model="form.first_name"
                                :class="{ 'ring-2 ring-red-500' : form.errors.first_name }" />
                            <div v-if="form.errors.first_name" class="mt-1 text-red-500">{{ form.errors.first_name }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-medium">Last name</label>
                        <div class="mt-1">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                class="wfg-form-field" :disabled="submitted || form.processing" v-model="form.last_name"
                                :class="{ 'ring-2 ring-red-500' : form.errors.last_name }" />
                            <div v-if="form.errors.last_name" class="mt-1 text-red-500">{{ form.errors.last_name }}
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" class="wfg-form-field"
                                :disabled="submitted || form.processing" v-model="form.email"
                                :class="{ 'ring-2 ring-red-500' : form.errors.email }" />
                            <div v-if="form.errors.email" class="mt-1 text-red-500">{{ form.errors.email }}</div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="wfg-form-field" :disabled="submitted || form.processing"
                                v-model="form.message" :class="{ 'ring-2 ring-red-500' : form.errors.message }" />
                            <div v-if="form.errors.message" class="mt-1 text-red-500">{{ form.errors.message }}</div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <VueRecaptcha v-show="!submitted" id="recaptcha" :sitekey=siteKey :load-recaptcha-script="true"
                            @verify="canSubmit=true" @expired="canSubmit=false" :class="{ 'opacity-50' : submitted }">
                        </VueRecaptcha>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" :disabled="form.processing || submitted || !canSubmit"
                            class="inline-flex w-full wfg-button h-14 disabled:pointer-events-none"
                            :class="{'opacity-50' : submitted || !canSubmit}">
                            <span v-show="form.processing" class="inline-flex w-full justify-center space-x-4">
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0s">
                                </div>
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0.1s">
                                </div>
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0.2s">
                                </div>
                            </span>
                            <span v-show="!form.processing">
                                {{ contactButtonString }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { VueRecaptcha } from 'vue-recaptcha'
import Swal from 'sweetalert2'
import { Inertia } from '@inertiajs/inertia'

const siteKey = '6Lcz7H8iAAAAAN0eSjhOjSFKFa6FR3zmR3UU1iyb'

const canSubmit = ref(false)

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    message: null,
})

const contactButtonString = ref('Submit')
const submitted = ref(false)

const submitContactForm = () => {
    form.post(route('save-contact-form'), {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true
            Swal.fire(
                'Success!',
                'Your message has been received.',
                'success'
            )
            contactButtonString.value = "Message Sent"
        },
        onError: () => { // Note - this only catches validation errors, not server-side issues. See below for details.
            contactButtonString.value = "Submit"
        }
    })
}

Inertia.on('invalid', (event) => {
    // Inertia expects us to create a custom error page to which it routes when a server error is encountered in response to an Inertia server request. This is problematic, because we're only communicating with the server to submit a form, and if a back-end error is encountered we'd rather catch that issue and handle it. Redirecting achieves nothing. 

    // Instead, we'll catch all global errors (we can't do this locally using the form helper as there's no way to actually catch the return of the post, it's all handled by Inertia). We'll then prevent the redirect/modal pop-up (so it doesn't cause a redirect or the error to appear in a full-screen modal, as it would, even on prod).

    // Note that this only works because we're only posting in one location, so we can use the global catcher locally. In future, with multiple forms and routes, we'll need to use Axios directly to submit where we don't want Inertia's default 'route to an error page if there's a problem' handling. 

    event.preventDefault()
    Swal.fire(
        'Error',
        'Your message could not be sent. Please try again later.',
        'info'
    )
})

</script>
