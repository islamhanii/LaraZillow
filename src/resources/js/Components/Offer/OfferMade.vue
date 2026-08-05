<template>
    <Box>
        <template #header> Offer Made </template>
        <Price :price="props.offerMade.amount" class="text-3xl" />
        <section class="mt2 flex flex-col md:flex-row justify-between text-gray-500">
            <div>Made on</div>
            <div class="font-medium">{{ offerMadeOn }}</div>
        </section>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Listing/Price.vue'

import { computed } from 'vue'

const props = defineProps({
    offerMade: Object
})

const offerMadeOn = computed(() => {
    return new Date(props.offerMade.created_at).toDateString()
})
</script>
