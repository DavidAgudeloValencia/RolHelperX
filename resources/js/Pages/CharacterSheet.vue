<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';

const userSheet = usePage().props.value.auth.user.sheet;
</script>

<template>

    <Head title="CharacterSheet" />

    <AuthenticatedLayout>
        <div style="height: 100vh !important;">
            <div class="lg:max-w-7xl lg:mx-auto lg:px-8 sm:w-11/12" style="height: 100% !important;">
                <div v-if="userSheet" class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:mx-4" style="height: 100% !important; margin-left: 1.5rem; margin-right: 1.5rem;">
                    <iframe  frameborder="0" style="height: 100%;" class="w-full overflow-hidden" :src=userSheet></iframe>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
