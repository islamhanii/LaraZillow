<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <section class="flex items-start flex-wrap gap-2 my-4">
                <div class="mr-4">
                    <input
                        class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:cursor-pointer"
                        type="file" ref="fileInput" @input="addFiles" multiple>
                    <div v-if="imageError" v-text="imageError" class="input-error"></div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                        :disabled="!canUpload">Upload</button>
                    <button type="reset" class="btn-outline" @click="reset">Reset</button>
                </div>
            </section>
        </form>
    </Box>
    <Box class="mt-4">
        <template #header>Uploaded Images</template>
        <div v-if="listing.images.length === 0" class="mt-4 text-center text-gray-700 dark:text-gray-400">
            No images uploaded yet.
        </div>
        <div v-else class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="image in listing.images" :key="image.id" class="relative">
                <img :src="image.url" alt="image" class="rounded-md w-full h-100 object-cover">
            </div>
        </div>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'

import { useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import nProgress from 'nprogress'

const props = defineProps({
    listing: Object
})

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        nProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

const fileInput = ref(null)

const uploadForm = useForm({
    images: []
})

const imageError = computed(() => {
    if (uploadForm.errors.images) {
        return uploadForm.errors.images
    }

    const firstKey = Object.keys(uploadForm.errors).find(key => key.startsWith('images.'))

    return firstKey ? uploadForm.errors[firstKey] : null
})

const upload = () => {
    uploadForm.post(route('realtor.listing.image.store', { listing: props.listing }), {
        forceFormData: true,
        onSuccess: () => {
            reset()
        }
    })
}

const addFiles = (event) => {
    uploadForm.images = []
    for (const image of event.target.files) {
        uploadForm.images.push(image)
    }
}

const reset = () => {
    uploadForm.reset()
    fileInput.value.value = null
}

const canUpload = computed(() => {
    return uploadForm.images.length > 0
})
</script>
