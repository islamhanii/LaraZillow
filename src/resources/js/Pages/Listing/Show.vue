<template>
    <div>
        <ListingAddress :listing="listing" />
    </div>
    <div>
        <Link :href="`/listing/${listing.id}/edit`">Edit</Link>
    </div>
    <div>
        <Link :href="`/listing/${listing.id}`" method="delete" as="button">Delete</Link>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    listing: Object
})
</script>
