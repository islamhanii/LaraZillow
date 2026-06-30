<template>
    <div>
        <Link href="/" style="margin-right: 10px;">Index Page</Link>
        <Link href="/show">Show Page</Link>
    </div>

    <div>
        This is a timer: {{ timer }}
    </div>

    <div v-if="flashSuccess" id="flash-success">
        {{ flashSuccess }}
    </div>

    <slot>Default Content</slot>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

// Get the flash success message from the server-side session
const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);

// Create a timer
const timer = ref(0);
setInterval(() => {
    timer.value++;
}, 1000);
</script>

<style scoped>
#flash-success {
    background-color: green;
    color: white;
    padding: 10px;
    margin: 10px 0;
}
</style>
