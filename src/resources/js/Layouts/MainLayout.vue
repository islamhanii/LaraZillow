<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="flex justify-between items-center p-4">
                <div class="text-lg font-medium dark:text-white">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-300 text-center">
                    <Link :href="route('listing.index')">LaraZillow</Link>
                </div>
                <div>
                    <Link :href="route('listing.create')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">+ New Listing</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div v-if="flashSuccess" class="rounded-md shadow-sm mb-4 border border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 px-4 py-3"  role="alert">
            {{ flashSuccess }}
        </div>

        <slot>Default Content</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Get the flash success message from the server-side session
const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
</script>
