<template>
  <!-- Header & Logo -->
  <Header :navigation="sections" />

  <!-- Hero section -->
  <section>
    <Hero />
  </section>

  <!-- Process -->
  <section>
    <div class="offset-section-anchor" :id="sections[0].id"></div>
    <Process />
  </section>

  <!-- About us -->
  <section>
    <div class="offset-section-anchor" :id="sections[1].id"></div>
    <About />
  </section>

  <!-- Our team -->
  <section>
    <div class="offset-section-anchor" :id="sections[2].id"></div>
    <Team />
  </section>

  <!-- Get in touch -->
  <section>
    <div class="offset-section-anchor" :id="sections[3].id"></div>
    <contact />
  </section>

  <!-- Footer -->
  <section>
    <Footer />
  </section>
</template>

<script setup>

import Header from '@/Layout/Header'
import Footer from '@/Layout/Footer'

import Hero from '@/Components/Sections/Hero'
import Process from '@/Components/Sections/Process'
import About from '@/Components/Sections/About'
import Team from '@/Components/Sections/Team'
import Contact from '@/Components/Sections/Contact'

const sections = [
  { name: 'Our process', id: 'process' },
  { name: 'About', id: 'about' },
  { name: 'Team', id: 'team' },
  { name: 'Contact us', id: 'contact' },
]

</script>