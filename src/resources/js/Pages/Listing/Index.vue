<template>
    <Filters />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
    </div>

    <div v-if="listings.data.length" class="w-full flex justify-center my-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Filters from '@/Components/Listing/Filters.vue'
import Listing from '@/Components/Listing/Listing.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({
    listings: Object
})
</script>
