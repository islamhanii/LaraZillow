<template>
    <div class="flex gap-1">
        <template v-for="(link, index) in links" :key="index">
            <!-- Active / Clickable Link -->
            <Link v-if="link.url" :href="link.url" v-html="link.label" class="px-4 py-2 rounded-md transition-colors"
                :class="{
                    'bg-indigo-500 dark:bg-indigo-800 text-white font-semibold': link.active,
                    'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300': !link.active
                }" />

            <!-- Disabled Link (url is null) -->
            <span v-else v-html="link.label"
                class="px-4 py-2 rounded-md text-gray-400 dark:text-gray-600 cursor-not-allowed" />
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    links: {
        type: Array,
        required: true
    }
})
</script>
