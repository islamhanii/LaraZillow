<template>
    <form @submit.prevent="createListing">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Beds</label>
                <input v-model.number="form.beds" type="number"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.beds" v-text="form.errors.beds" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-4">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Baths</label>
                <input v-model.number="form.baths" type="number"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.baths" v-text="form.errors.baths" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-4">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Area</label>
                <input v-model.number="form.area" type="number"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.area" v-text="form.errors.area" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-8">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">City</label>
                <input v-model="form.city" type="text"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.city" v-text="form.errors.city" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-4">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Post Code</label>
                <input v-model="form.code" type="text"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.code" v-text="form.errors.code" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-8">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Street</label>
                <input v-model="form.street" type="text"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.street" v-text="form.errors.street" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div class="col-span-4">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Street Nr</label>
                <input v-model="form.street_nr" type="text"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.street_nr" v-text="form.errors.street_nr" class="text-red-500 text-sm mt-1">
                </div>
            </div>

            <div class="col-span-12">
                <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Price</label>
                <input v-model.number="form.price" type="number"
                    class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
                <div v-if="form.errors.price" v-text="form.errors.price" class="text-red-500 text-sm mt-1"></div>
            </div>

            <div>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">Edit</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    listing: Object
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price
})

const createListing = () => {
    form.put(route('listing.update', { listing: props.listing.id }))
}
</script>
