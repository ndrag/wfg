<template>
    <div class="section-body bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12 lg:grid lg:grid-cols-3 lg:gap-8 lg:space-y-0">
                <div class="space-y-5 sm:space-y-4">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Our Team</h2>
                    <p class="text-xl text-gray-500"></p>
                    <!-- TODO: Add a description above. -->
                </div>
                <div class="lg:col-span-2">
                    <ul role="list"
                        class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:gap-x-8">
                        <li v-for="person in people" :key="person.name">
                            <div class="space-y-4">
                                <div class="aspect-w-3 aspect-h-2">
                                    <img class="rounded-lg object-cover shadow-lg" :src="person.imageUrl" alt="" />
                                </div>
                                <div class="space-y-1 text-lg font-semibold leading-6">
                                    <h3>{{ person.name }}</h3>
                                    <p class="text-wfg-violet">{{ person.role }} </p>
                                    <p class="text-wfg-blue">{{ person.country}}</p>
                                </div>
                                <div class="text-lg">
                                    <p class="text-gray-500">{{ person.bio }}</p>
                                </div>

                                <ul role="list" class="flex space-x-5">
                                    <li>
                                        <a :href="person.linkedinUrl" target="_blank" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">LinkedIn</span>
                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const people = [
    {
        name: 'Nick Dragunow',
        role: 'Web Developer',
        imageUrl:
            '/assets/images/headshots/nick-headshot.jpg',
        bio: 'Nick Dragunow.',
        linkedinUrl: 'https://github.com/ndrag',
        country: 'Vancouver, Canada'
    },
    {
        name: 'Jon Leonard',
        role: 'Business Analyst',
        imageUrl:
            '/assets/images/headshots/nick-headshot.jpg',
        bio: 'Nick Dragunow.',
        linkedinUrl: 'https://github.com/ndrag',
        country: 'Christchurch, New Zealand'
    },
]
</script>
