<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <div>
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
                    <button type="submit" class="btn-primary w-full">Login</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null
})

const login = () => form.post(route('login.store'))
</script>
