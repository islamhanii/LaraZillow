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
                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500">{{ user.name }}</div>
                    <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
                    <Link :href="route('logout')" method="delete" as="button"
                        class="text-red-500 hover:text-red-700 cursor-pointer">
                        Logout</Link>
                </div>
                <div v-else class="flex items-center gap-4">
                    <Link :href="route('user-account.create')" class="dark:text-white">Register</Link>
                    <Link :href="route('login')" class="dark:text-white">Login</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess"
            class="rounded-md shadow-sm mb-4 border border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 px-4 py-3"
            role="alert">
            {{ flashSuccess }}
        </div>

        <slot>Default Content</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

// Get the flash success message from the server-side session
const page = usePage()
const flashSuccess = computed(() => page.props.flash?.success)
const user = computed(() => page.props.user)
</script>
