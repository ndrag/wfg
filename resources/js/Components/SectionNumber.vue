<template>
    <div class="mx-auto pl-0 rounded-lg w-full h-16 opacity-80 text-center bg-wfg-blue bg-gradient-to-b from-wfg-violet align-middle text-white text-4xl font-bold sm:w-16 sm:rounded-full" style="line-height: 3.8rem">
        <span>{{ value }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    value: String,
})
</script>