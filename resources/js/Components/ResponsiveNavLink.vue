<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'block w-full text-base font-medium text-white bg-primary focus:outline-none focus:text-gray-900 focus:bg-indigo-900 focus:transition duration-150 ease-in-out'
        : 'block w-full text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-indigo-5900 focus:outline-none focus:text-gray-900 focus:bg-indigo-900 focus:transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
