<template>
    <form @submit.prevent="createListing">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4">
                <label class="label">Beds</label>
                <input v-model.number="form.beds" type="number" class="input" />
                <div v-if="form.errors.beds" v-text="form.errors.beds" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label class="label">Baths</label>
                <input v-model.number="form.baths" type="number" class="input" />
                <div v-if="form.errors.baths" v-text="form.errors.baths" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label class="label">Area</label>
                <input v-model.number="form.area" type="number" class="input" />
                <div v-if="form.errors.area" v-text="form.errors.area" class="input-error"></div>
            </div>

            <div class="col-span-8">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class="input" />
                <div v-if="form.errors.city" v-text="form.errors.city" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label class="label">Post Code</label>
                <input v-model="form.code" type="text" class="input" />
                <div v-if="form.errors.code" v-text="form.errors.code" class="input-error"></div>
            </div>

            <div class="col-span-8">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class="input" />
                <div v-if="form.errors.street" v-text="form.errors.street" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label class="label">Street Nr</label>
                <input v-model="form.street_nr" type="text" class="input" />
                <div v-if="form.errors.street_nr" v-text="form.errors.street_nr" class="input-error">
                </div>
            </div>

            <div class="col-span-12">
                <label class="label">Price</label>
                <input v-model.number="form.price" type="number" class="input" />
                <div v-if="form.errors.price" v-text="form.errors.price" class="input-error"></div>
            </div>

            <div>
                <button type="submit" class="btn-primary">Edit</button>
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
