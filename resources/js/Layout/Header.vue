<template>
    <Disclosure as="nav" class="bg-gray-700 fixed w-full z-40 drop-shadow-md shadow-wfg-violet" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                
                <!-- Mobile menu button-->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden text-white">
                    <DisclosureButton class="header-link inline-flex items-center justify-center p-2">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>

                <!-- Logo & desktop nav -->
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <a class="flex flex-shrink-0 items-center" href="#">
                        <img class="block h-10 w-auto sm:hidden" src="/images/logo/violet/wfg-logo-wide-darkest.svg" alt="Works for Good" />
                        <img class="hidden h-10 w-auto sm:block" src="/images/logo/violet/wfg-logo-darkest.svg" alt="Works for Good" />
                    </a>
                    <div class="hidden sm:ml-6 sm:block text-white">
                        <div class="flex space-x-4">
                            <a v-for="item in navigation" :key="item.name" :href="'#' + item.id"
                                class="header-link px-3 py-2 text-sm font-medium">
                                {{item.name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile panel -->
        <DisclosurePanel class="sm:hidden bg-gradient-to-t from-gray-800">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="'#' + item.id"
                    class="header-link block px-3 py-2 text-base font-medium text-white">
                    {{ item.name }}</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>
  
<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

import HeaderLink from "@/Components/HeaderLink"

const props = defineProps({
    navigation: Array,
})
</script>