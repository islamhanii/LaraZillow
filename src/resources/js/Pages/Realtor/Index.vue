<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section>
        <Filters :filters="filters" />
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{ 'opacity-25': listing.deleted_at }">
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
                <div>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a class="btn-outline text-xs font-medium" :href="route('listing.show', { listing: listing.id })"
                            target="_blank" rel="noopener noreferrer">
                            Preview
                        </a>
                        <Link class="btn-outline text-xs font-medium"
                            :href="route('realtor.listing.edit', { listing: listing.id })">Edit</Link>
                        <Link v-if="!listing.deleted_at" :href="route('realtor.listing.destroy', { listing: listing.id })"
                            as="button" method="delete" class="btn-outline text-xs font-medium">Delete</Link>
                        <Link v-else :href="route('realtor.listing.restore', { listing: listing.id })" as="button"
                            method="put" class="btn-outline text-xs font-medium">Restore</Link>
                    </div>
                    <div class="mt-2">
                        <Link :href="route('realtor.listing.image.create', { listing: listing.id })" class="block w-full btn-outline text-xs font-medium text-center">Images</Link>
                    </div>
                </div>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length" class="w-full flex justify-center my-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue'
import Price from '@/Components/Listing/Price.vue'
import ListingSpace from '@/Components/Listing/ListingSpace.vue'
import Filters from '@/Components/Realtor/Filters.vue'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'

import { Link } from '@inertiajs/vue3'

defineProps({
    listings: Object,
    filters: Object
})
</script>
