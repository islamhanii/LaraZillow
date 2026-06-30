<template>
    <div>
        <ListingAddress :listing="listing" />
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue';
defineProps({
    listing: Object
})
</script>
