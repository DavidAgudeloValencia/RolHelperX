<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-dark">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-30 h-30 fill-current text-white bg-transparent" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-transparent"
        >
            <slot />
        </div>
    </div>
</template>
