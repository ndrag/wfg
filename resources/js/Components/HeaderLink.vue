<template>
    <Link :href="route(link)"><i class="far fa-user" /> {{ name }}</Link>
    <span class="opacity-70">|</span>
</template>

<script setup>
const props = defineProps({
    name: String,
    link: String,
})
</script>