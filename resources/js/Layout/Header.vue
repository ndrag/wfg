<template>
    <header
        class="bg-blue-200 text-white flex justify-between items-center px-6 h-[60px] font-heading w-full fixed top-0 z-50">
        <span>
            <p>Logo</p>
        </span>
        <span class="flex items-center space-x-2">
            <HeaderLink v-for="item in navigation" :key="item.name" :name="item.name" :link="item.href"/>
        </span>
        <span>
        </span>
    </header>
</template>

<script setup>

import HeaderLink from "@/Components/HeaderLink"

const navigation = [
    { name: 'About us', href: 'homepage' },
    { name: 'Our process', href: 'homepage' },
    { name: 'Our  team', href: 'homepage' },
    { name: 'Advisors', href: 'homepage' },
    { name: 'Get in touch', href: 'homepage' },
]

</script>