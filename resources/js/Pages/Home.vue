<template>
  <Header :navigation="sections" />

  <section>
    <Hero />
  </section>

  <section>
    <div class="offset-section-anchor" :id="sections[0].id"></div>
    <About />
  </section>

  <section>
    <div class="offset-section-anchor" :id="sections[1].id"></div>
    <Process />
  </section>

  <section>
    <div class="offset-section-anchor" :id="sections[2].id"></div>
    <contact />
  </section>

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
import Contact from '@/Components/Sections/Contact'

const sections = [
  { name: 'About', id: 'about' },
  { name: 'Our process', id: 'process' },
  { name: 'Contact us', id: 'contact' },
]

</script>