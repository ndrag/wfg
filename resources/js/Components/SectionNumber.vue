<template>
    <div class="mx-auto pl-0 rounded-full w-[85px] h-[85px] text-[54px] leading-[86px] sm:leading-[80px] opacity-80 text-center bg-wfg-blue bg-gradient-to-b from-wfg-violet align-middle text-white font-bold">
        <span>{{ value }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    value: String,
})
</script>