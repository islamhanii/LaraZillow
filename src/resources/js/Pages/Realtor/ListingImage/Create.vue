<template>
    <form :action="route('realtor.listing.image.store', { listing: listing.id })" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <button type="submit">Upload</button>
    </form>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
