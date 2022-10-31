<template>
    <div class="mx-auto pl-0 rounded-full w-[96px] h-[96px] opacity-80 text-center bg-wfg-blue bg-gradient-to-b from-wfg-violet align-middle text-white text-[54px] leading-[90px] font-bold">
        <span>{{ value }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    value: String,
})
</script>