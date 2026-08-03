<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <div v-if="listing.images.length === 0" class="text-gray-500 font-medium">
                No Images
            </div>
            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-2 w-full">
                <div v-for="image in listing.images" :key="image.id" class="w-full h-100 object-cover">
                    <img :src="image.url" alt="Listing Image" class="w-full h-100 object-cover rounded-lg">
                </div>
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

                    <div class="text-gray-500 mt-2">
                        <div class="flex justify-between">
                            <div>Total Paid</div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <div>Principal Paid</div>
                            <Price :price="listing.price" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <div>Total Interest Paid</div>
                            <Price :price="totalInterestPaid" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer v-if="user" @offer-updated="offer = $event" :listing-id="listing.id" :price="listing.price" />
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/Listing/ListingAddress.vue'
import ListingSpace from '@/Components/Listing/ListingSpace.vue'
import MakeOffer from '@/Components/Listing/MakeOffer.vue'
import Price from '@/Components/Listing/Price.vue'
import Box from '@/Components/UI/Box.vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'

import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

import { ref } from 'vue'

const props = defineProps({
    listing: Object
})

const offer = ref(props.listing.price)
const interestRate = ref(2.5)
const duration = ref(25)

const { monthlyPayment, totalPaid, totalInterestPaid } = useMonthlyPayment(offer, interestRate, duration)

const page = usePage()
const user = computed(() => page.props.user)
</script>
