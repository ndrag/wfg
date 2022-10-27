<template>
    <div class="section-body">
        <div class="body-container">
            <div class="text-center">
                <h2>Contact us</h2>
                <p>Send as a message and we'll contact you if we think we can help.</p>
            </div>

            <div class="mt-12">
                <form @submit.prevent="submitContactForm" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8"
                    :class="{ 'opacity-50' : Submitted }">
                    <div>
                        <label for="first-name" class="block text-sm font-medium">First name</label>
                        <div class="mt-1">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="wfg-form-field" :disabled="Submitted || Form.processing"
                                v-model="Form.first_name" :class="{ 'input-error-ring': Form.errors.first_name }" />
                            <div v-if="Form.errors.first_name" class="mt-1 text-red-500">{{ Form.errors.first_name }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-medium">Last name</label>
                        <div class="mt-1">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                class="wfg-form-field" :disabled="Submitted || Form.processing" v-model="Form.last_name"
                                :class="{ 'input-error-ring': Form.errors.last_name }" />
                            <div v-if="Form.errors.last_name" class="mt-1 text-red-500">{{ Form.errors.last_name }}
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" class="wfg-form-field"
                                :disabled="Submitted || Form.processing" v-model="Form.email"
                                :class="{ 'input-error-ring': Form.errors.email }" />
                            <div v-if="Form.errors.email" class="mt-1 text-red-500">{{ Form.errors.email }}</div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="inquiry-type" class="block text-sm font-medium">I'm inquiring about</label>
                        <Listbox v-model="Form.inquiry">
                            <div class="relative mt-1">
                                <ListboxButton id="inquiry-type"
                                    class="relative w-full cursor-default wfg-form-field text-left border-gray-200 bg-gray-50 border-2 shadow-none"
                                    :class="{ 'input-error-ring': Form.errors.inquiry }">
                                    <span class="block truncate">{{ Form.inquiry }}</span>
                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-600" aria-hidden="true" />
                                    </span>
                                </ListboxButton>
                                <div v-if="Form.errors.inquiry" class="mt-1 text-red-500">{{ Form.errors.inquiry }}
                                </div>


                                <transition leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100" leave-to-class="opacity-0">
                                    <ListboxOptions
                                        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                        <ListboxOption v-slot="{ active, selected }" v-for="inquiryType in inquiryTypes"
                                            :key="inquiryType" :value="inquiryType">
                                            <li :class="[
                                                active ? 'bg-wfg-violet opacity-80 text-white' : 'text-gray-600',
                                                'relative cursor-default select-none py-2 pl-10 pr-4',
                                            ]">
                                                <span :class="[
                                                    selected ? 'font-medium' : 'font-normal',
                                                    'block truncate',
                                                ]">{{ inquiryType }}</span>
                                                <span v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-wfg-violet font-extrabold">
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                            </li>
                                        </ListboxOption>
                                    </ListboxOptions>
                                </transition>
                            </div>
                        </Listbox>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="wfg-form-field"
                                :disabled="Submitted || Form.processing" v-model="Form.message"
                                :class="{ 'input-error-ring': Form.errors.message }" />
                            <div v-if="Form.errors.message" class="mt-1 text-red-500">{{ Form.errors.message }}</div>
                        </div>
                    </div>
                    <div class="sm:col-span-2" :class="Submitted ? 'h-24 pt-2' : ''">
                        <VueRecaptcha v-if="!Submitted" class="h-24 pt-2" :disabled="Submitted || Form.processing"
                            id="recaptcha" ref="recaptcha" :sitekey=SiteKey :load-recaptcha-script="true"
                            @verify="handleRecaptchaValidation" @expired="CanSubmit = false">
                        </VueRecaptcha>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" :disabled="Form.processing || Submitted || !CanSubmit"
                            class="inline-flex w-full wfg-button h-14 disabled:pointer-events-none"
                            :class="{ 'opacity-50': Submitted || !CanSubmit }">
                            <span v-show="Form.processing" class="inline-flex w-full justify-center space-x-4">
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0s">
                                </div>
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0.1s">
                                </div>
                                <div class="w-2 h-2 bg-white rounded-full animate-ping" style="animation-delay: 0.2s">
                                </div>
                            </span>
                            <span v-show="!Form.processing">
                                {{ ContactButtonString }}
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
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import axios from 'axios'

const recaptcha  = ref(null)
const SiteKey = '6Lcz7H8iAAAAAN0eSjhOjSFKFa6FR3zmR3UU1iyb'
const CanSubmit = ref(false)


const inquiryTypes = [
    'Support for myself or my organization',
    'Becoming a team member',
    'Becoming a technical advisor',
]


const Form = useForm({
    first_name: null,
    last_name: null,
    contact_type: null,
    email: null,
    message: null,
    inquiry: ref(inquiryTypes[0]),
})

const ContactButtonString = ref('Submit')
const Submitted = ref(false)

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,

})

const handleRecaptchaValidation = async (value) => {
    try {
        await axios.post(route('validate-recaptcha-response'), {
            "recaptcha_validation_token": value
        })
        CanSubmit.value = true
    } catch (err) {
        Toast.fire({
            text: err.response.data.message,
            iconHtml: `<img class="b-none h-24 w-auto mx-auto block" src="assets/images/icons/wfg-times-dark.svg" alt="${ err.response.data.message}" />`,
            iconColor: 'white',
        })
        recaptcha.value.reset()
    }
}

const submitContactForm = () => {
    Form.post(route('save-contact-form'), {
        preserveScroll: true,
        onSuccess: () => {
            Submitted.value = true
            Toast.fire({
                text: "Thanks! Your message has been received.",
                iconHtml: '<img class="b-none h-24 w-auto mx-auto block" src="/assets/images/icons/wfg-check-dark.svg" alt="Works for Good" />',
                iconColor: 'white'
            })
            ContactButtonString.value = "Message Sent"
        },
        onError: () => { // Note - this only catches validation errors, not server-side issues. See below for details.
            ContactButtonString.value = "Submit"
        }
    })
}

Inertia.on('invalid', (event) => {
    // Inertia expects us to create a custom error page to which it routes when a server error is encountered in response to an Inertia server request. This is problematic, because we're only communicating with the server to submit a form, and if a back-end error is encountered we'd rather catch that issue and handle it. Redirecting achieves nothing. 

    // Instead, we'll catch all global errors (we can't do this locally using the form helper as there's no way to actually catch the return of the post, it's all handled by Inertia). We'll then prevent the redirect/modal pop-up (so it doesn't cause a redirect or the error to appear in a full-screen modal, as it would, even on prod).

    // Note that this only works because we're only posting in one location, so we can use the global catcher locally. In future, with multiple forms and routes, we'll need to use Axios directly to submit where we don't want Inertia's default 'route to an error page if there's a problem' handling. 

    event.preventDefault()
    Toast.fire({
        text: "Your message could not be sent. Please try again later.",
        iconHtml: '<img class="b-none h-24 w-auto mx-auto block" src="assets/images/icons/wfg-times-dark.svg" alt="Your message could not be sent. Please try again later." />',
        iconColor: 'white',
    })
})

</script>
