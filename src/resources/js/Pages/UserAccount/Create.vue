<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <div>
                    <label for="name" class="label">Name</label>
                    <input id="name" v-model="form.name" type="text" class="input" />
                    <div v-if="form.errors.name" v-text="form.errors.name" class="input-error"></div>
                </div>
                <div class="mt-4">
                    <label for="email" class="label">Email</label>
                    <input id="email" v-model="form.email" type="email" class="input" />
                    <div v-if="form.errors.email" v-text="form.errors.email" class="input-error"></div>
                </div>
                <div class="mt-4">
                    <label for="password" class="label">Password</label>
                    <input id="password" v-model="form.password" type="password" class="input" />
                    <div v-if="form.errors.password" v-text="form.errors.password" class="input-error"></div>
                </div>
                <div class="mt-4">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <input id="password_confirmation" v-model="form.password_confirmation" type="password"
                        class="input" />
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn-primary w-full">Create Account</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
})

const register = () => form.post(route('user-account.store'))
</script>
