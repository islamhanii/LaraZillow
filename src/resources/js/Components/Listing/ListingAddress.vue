<template>
    <span>
        {{ listing.street }}, {{ listing.street_nr }}, {{ listing.city }}, for {{ listing.price }} USD
    </span>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
