<template>
    <Link class="text-sm font-bold text-gray-900 mx-3" :href="route(href)">{{ name }}</Link>
    <span v-if="!(index == arrayLength - 1)" class="cursor-default opacity-70">|</span>
</template>

<script setup>
const props = defineProps({
    name: String,
    href: String,
    index: Number,
    arrayLength: Number,
})
</script>