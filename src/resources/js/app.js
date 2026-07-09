import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import DefaultLayout from './Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy-js'

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')

        // 1. Fetch the module from the glob object
        const pageModule = pages[`./Pages/${name}.vue`]

        if (!pageModule) {
            throw new Error(`Page ./Pages/${name}.vue not found. Check your file name and path.`)
        }

        // 2. Await the import function
        const page = await pageModule()

        // 3. Apply your persistent default layout
        page.default.layout = page.default.layout || DefaultLayout

        // 4. CRITICAL: Return the page so Inertia can render it!
        return page
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },

    progress: {
        delay: 0,
        color: "#29d",
        includeCSS: true,
        showSpinner: false,
    },
})
