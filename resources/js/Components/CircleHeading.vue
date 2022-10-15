<template>
    <div class="mx-auto rounded-full w-24 h-24 text-center bg-wfg-blue bg-gradient-to-b from-wfg-violet align-middle text-white text-6xl pl-0.5 font-bold" style="line-height: 5.6rem">
        <span>{{ value }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    value: String,
})
</script>