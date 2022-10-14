<template>
    <div class="section-body overflow-hidden bg-white py-16 px-4 sm:px-6 lg:px-8 lg:py-24">
        <div class="relative mx-auto max-w-xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Contact us</h2>
                <p class="mt-4 text-lg">For more information, please contact us using the form below.</p>
            </div>

            <div class="mt-12">
                <form @submit.prevent="submitContactForm" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div>
                        <label for="first-name" class="block text-sm font-medium">First name</label>
                        <div class="mt-1">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="wfg-form-field" v-model="form.first_name"
                                :class="{ 'ring-2 ring-red-500' : form.errors.first_name }" />
                            <div v-if="form.errors.first_name" class="mt-1 text-red-500">{{ form.errors.first_name }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-medium">Last name</label>
                        <div class="mt-1">
                            <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                class="wfg-form-field" v-model="form.last_name"
                                :class="{ 'ring-2 ring-red-500' : form.errors.last_name }" />
                            <div v-if="form.errors.last_name" class="mt-1 text-red-500">{{ form.errors.last_name }}
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" class="wfg-form-field"
                                v-model="form.email" :class="{ 'ring-2 ring-red-500' : form.errors.email }" />
                            <div v-if="form.errors.email" class="mt-1 text-red-500">{{ form.errors.email }}</div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="wfg-form-field" v-model="form.message"
                                :class="{ 'ring-2 ring-red-500' : form.errors.message }" />
                            <div v-if="form.errors.message" class="mt-1 text-red-500">{{ form.errors.message }}</div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <VueRecaptcha id="recaptcha" :sitekey=siteKey :load-recaptcha-script="true"
                            @verify="canSubmit=true" @expired="canSubmit=false"></VueRecaptcha>
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
            form.defaults()
            contactButtonString.value = "Submitted"
        },
        onError: () => {
            contactButtonString.value = "Submit"
        }
    })
}


</script>
