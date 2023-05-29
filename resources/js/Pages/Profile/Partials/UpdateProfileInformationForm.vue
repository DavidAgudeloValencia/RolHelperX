<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { InformationCircleIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    sheet: user.sheet,
    skill: user.skill,
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="props.status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div>
                <div>
                    <Popover v-slot="{ open }">
                        <PopoverButton :class="open ? '' : 'text-opacity-90'"
                            class="group inline-flex items-center rounded-md bg-transparent hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                            <InputLabel for="skill" value="Character sheet iframe" />
                            <InformationCircleIcon :class="open ? '' : 'text-opacity-70'"
                                class="ml-2 h-5 w-5 text-gray-600 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition duration-200 ease-out"
                            enter-from-class="translate-y-1 opacity-0" enter-to-class="translate-y-0 opacity-100"
                            leave-active-class="transition duration-150 ease-in"
                            leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                            <PopoverPanel
                                class="absolute left-1/2 w-screen max-w-sm -translate-x-1/2 transform px-4 sm:px-0 lg:max-w-3xl">
                                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                    <div class="bg-gray-50 p-4">
                                        <a href="##"
                                            class="flow-root rounded-md px-2 py-2 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus-visible:ring focus-visible:ring-orange-500 focus-visible:ring-opacity-50">
                                            <span class="flex items-center">
                                                <span class="text-sm font-medium text-gray-900">
                                                    Additional information
                                                </span>
                                            </span>
                                            <span class="block text-sm text-gray-500">
                                                You are expected to enter the url of the iframe of your character's google
                                                document, the iframe can be requested from the role master otherwise you can
                                                use your own document. example: https://docs.google.com/document/d/e/...
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>
                </div>
                <TextArea name="sheet" id="sheet" v-model="form.sheet" required
                    autocomplete="Character Sheet" />

                <InputError class="mt-2" :message="form.errors.sheet" />
            </div>

            <div>
                <div>
                    <Popover v-slot="{ open }">
                        <PopoverButton :class="open ? '' : 'text-opacity-90'"
                            class="group inline-flex items-center rounded-md bg-transparent hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                            <InputLabel for="skill" value="Skills sheet iframe" />
                            <InformationCircleIcon :class="open ? '' : 'text-opacity-70'"
                                class="ml-2 h-5 w-5 text-gray-600 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition duration-200 ease-out"
                            enter-from-class="translate-y-1 opacity-0" enter-to-class="translate-y-0 opacity-100"
                            leave-active-class="transition duration-150 ease-in"
                            leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                            <PopoverPanel
                                class="absolute left-1/2 w-screen max-w-sm -translate-x-1/2 transform px-4 sm:px-0 lg:max-w-3xl">
                                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                    <div class="bg-gray-50 p-4">
                                        <a href="##"
                                            class="flow-root rounded-md px-2 py-2 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus-visible:ring focus-visible:ring-orange-500 focus-visible:ring-opacity-50">
                                            <span class="flex items-center">
                                                <span class="text-sm font-medium text-gray-900">
                                                    Additional information
                                                </span>
                                            </span>
                                            <span class="block text-sm text-gray-500">
                                                You are expected to enter the url of the iframe of your character's google
                                                document, the iframe can be requested from the role master otherwise you can
                                                use your own document. example: https://docs.google.com/document/d/e/...
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>
                </div>
                <TextArea name="skill" id="skill" v-model="form.skill" required
                    autocomplete="Skills Sheet" />

                <InputError class="mt-2" :message="form.errors.skill" />
            </div>


            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
