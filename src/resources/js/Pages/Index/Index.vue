<template>
  <div>
    <h1>{{ message }}</h1>
    <p>This is the main page of the application.</p>
  </div>
</template>

<script setup>
defineProps({
  message: String
});
</script>
