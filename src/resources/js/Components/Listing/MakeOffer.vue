<template>
    <Box>
        <template #header> Make an Offer </template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="offerForm.amount" type="text" class="input mt-2" />
                <input v-model.number="offerForm.amount" type="range" :min="minOffer" :max="maxOffer" step="10000"
                    class="mt-2 w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer">
                <button type="submit" class="btn-outline w-full mt-2 text-sm">Make an Offer</button>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import Price from '@/Components/Listing/Price.vue'
import Box from '@/Components/UI/Box.vue'

import { useForm } from '@inertiajs/vue3'
import { computed, watch } from 'vue'
import { debounce } from 'lodash'

const props = defineProps({
    listingId: Number,
    price: Number,
})

const offerForm = useForm({
    amount: props.price,
})

const makeOffer = () => {
    offerForm.post(route('listing.offer.store', props.listingId), {
        preserveScroll: true,
        preserveState: true,
    })
}

const difference = computed(() => offerForm.amount - props.price)
const minOffer = computed(() => Math.round(props.price / 2))
const maxOffer = computed(() => Math.round(props.price * 2))

const emit = defineEmits(['offerUpdated'])

watch(() => offerForm.amount, debounce(() => {
    emit('offerUpdated', offerForm.amount)
}, 200))
</script>
