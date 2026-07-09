<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <div class="text-gray-500 font-medium">
                No Images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic Information
                </template>
                <div>
                    <Link :href="route('listing.show', { listing: listing.id })">
                        <Price :price="listing.price" class="text-2xl font-bold" />
                        <ListingSpace :listing="listing" class="text-lg" />
                        <ListingAddress :listing="listing" class="text-gray-500" />
                    </Link>
                </div>
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                Make an offer
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue'
import ListingSpace from '@/Components/Listing/ListingSpace.vue'
import Price from '@/Components/Listing/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
defineProps({
    listing: Object
})
</script>
