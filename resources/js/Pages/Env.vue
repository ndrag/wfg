<template>
  <span>
    <ul>
      <li v-for="(value, key, index) in $page.props.env_vars" 
        :key="index">
        {{ key }} : {{ value }}
      </li>
    </ul>
  </span>
</template>