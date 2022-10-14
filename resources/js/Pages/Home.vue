<template>
  <!-- Header & Logo -->
  <Header :navigation="sections" />

  <!-- Hero section -->
  <section>
    <div :id="sections[0].id"></div>
    <Hero />
  </section>
  
  <!-- About us -->
  <section>
    <!-- <div class="section-anchor" :id="sections[1].id"></div> -->
  </section>
  
  <!-- Our team -->
  <section>
    <div class="offset-section-anchor" :id="sections[2].id"></div>
    <Team />
  </section>
  
  <!-- Technical advisors -->
  <section>
  </section>
  
  <!-- Get in touch -->
  <section>
    <div class="offset-section-anchor" :id="sections[4].id"></div>
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
import Team from '@/Components/Sections/Team'
import Contact from '@/Components/Sections/Contact'

const sections = [
  { name: 'About', id: 'about' },
  { name: 'Our process', id: 'process' },
  { name: 'Team', id: 'team' },
  { name: 'Advisors', id: 'advisors' },
  { name: 'Contact us', id: 'contact' },
]

</script>