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
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <ListingSpace :listing="listing" class="text-lg" />
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Interest Rate ({{ interestRate }}%)</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                        class="w-full bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer">
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input v-model.number="duration" type="range" min="3" max="25" step="1"
                        class="w-full bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer">

                    <div class="text-gray-600 dark:text-gray-300">
                        <div class="text-gray-400">Your Monthly Payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue'
import ListingSpace from '@/Components/Listing/ListingSpace.vue'
import Price from '@/Components/Listing/Price.vue'
import Box from '@/Components/UI/Box.vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'

import { ref } from 'vue'

const props = defineProps({
    listing: Object
})

const interestRate = ref(2.5)
const duration = ref(25)

const { monthlyPayment } = useMonthlyPayment(props.listing.price, interestRate, duration)
</script>
