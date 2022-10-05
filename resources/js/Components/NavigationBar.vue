<template>
    <!-- Dropdown toggle -->
    <button data-collapse-toggle="navbar" type="button"
        class="inline-flex justify-center items-center ml-3 text-gray-400 rounded-lg md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-500"
        aria-controls="navbar" aria-expanded="false">
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
        </svg>
    </button>

    <!-- Navbar buttons / drop-down elements -->
    <nav class="hidden w-full md:block md:w-auto" id="navbar">
        <ul
            class="flex flex-col mt-4 bg-gray-50 rounded-lg md:flex-row md:mt-0 md:space-x-8 md:text-sm md:font-medium md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
            <li class="flex items-center">
                <HeaderLink v-for="(item, index) in navigation" :key="item.name" :name="item.name" :href="item.href" :index="index" :array-length="navigation.length"/>
            </li>
        </ul>
    </nav>
</template>

<script setup>

import HeaderLink from "@/Components/HeaderLink"

const navigation = [
    { name: 'About', href: 'homepage' },
    { name: 'Our process', href: 'homepage' },
    { name: 'Team', href: 'homepage' },
    { name: 'Advisors', href: 'homepage' },
    { name: 'Contact us', href: 'homepage' },
]
</script>