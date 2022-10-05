<template>

    <nav class="px-6 h-[40px] sm:h-[60px] font-heading w-full fixed top-0 z-50 bg-gray-50 rounded border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="container h-full w-full flex flex-wrap justify-between items-center max-w-none">

            <!-- Logo -->
            <a href="#">
                <img src="/favicon.ico" class="mr-3 h-6 sm:h-10" alt="Works for Good Logo" /> <!-- TODO: Swap the favicon for a full-size SVG logo. -->
            </a>

            <NavigationBar/>
        </div>
    </nav>
</template>

<script setup>

import NavigationBar from "@/Components/NavigationBar"

</script>