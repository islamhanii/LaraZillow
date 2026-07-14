<template>
    <form @submit.prevent="createListing">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4">
                <label for="beds" class="label">Beds</label>
                <input id="beds" v-model.number="form.beds" type="number" class="input" />
                <div v-if="form.errors.beds" v-text="form.errors.beds" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label for="baths" class="label">Baths</label>
                <input id="baths" v-model.number="form.baths" type="number" class="input" />
                <div v-if="form.errors.baths" v-text="form.errors.baths" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label for="area" class="label">Area</label>
                <input id="area" v-model.number="form.area" type="number" class="input" />
                <div v-if="form.errors.area" v-text="form.errors.area" class="input-error"></div>
            </div>

            <div class="col-span-8">
                <label for="city" class="label">City</label>
                <input id="city" v-model="form.city" type="text" class="input" />
                <div v-if="form.errors.city" v-text="form.errors.city" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label for="code" class="label">Post Code</label>
                <input id="code" v-model="form.code" type="text" class="input" />
                <div v-if="form.errors.code" v-text="form.errors.code" class="input-error"></div>
            </div>

            <div class="col-span-8">
                <label for="street" class="label">Street</label>
                <input id="street" v-model="form.street" type="text" class="input" />
                <div v-if="form.errors.street" v-text="form.errors.street" class="input-error"></div>
            </div>

            <div class="col-span-4">
                <label for="street_nr" class="label">Street Nr</label>
                <input id="street_nr" v-model="form.street_nr" type="text" class="input" />
                <div v-if="form.errors.street_nr" v-text="form.errors.street_nr" class="input-error">
                </div>
            </div>

            <div class="col-span-12">
                <label for="price" class="label">Price</label>
                <input id="price" v-model.number="form.price" type="number" class="input" />
                <div v-if="form.errors.price" v-text="form.errors.price" class="input-error"></div>
            </div>

            <div>
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    code: null,
    street: null,
    street_nr: null,
    price: 0
})

const createListing = () => {
    form.post(route('listing.store'))
}
</script>
