<template>
    <div>
        <Link href="/" style="margin-right: 10px;">Index Page</Link>
        <Link href="/show">Show Page</Link>
    </div>
    <div>
        This is a timer: {{ timer }}
    </div>
    <slot>Default Content</slot>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<script>
import { ref } from 'vue';

const timer = ref(0);

setInterval(() => {
    timer.value++;
}, 1000);
</script>