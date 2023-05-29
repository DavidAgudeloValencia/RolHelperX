<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, useForm, usePage, router } from '@inertiajs/inertia-vue3';


import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const userState = usePage().props.value.auth.userState;

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

const currentStates = useForm({
    id: userState ? userState.id : 0,
    user_id: usePage().props.value.auth.user.id ? usePage().props.value.auth.user.id : 0,
    life: userState ? userState.life : 0,
    main_magic: userState ? userState.main_magic : 0,
    secondary_magic: userState ? userState.secondary_magic : 0,
    tertiary_magic: userState ? userState.tertiary_magic : 0,
    dice_4: userState ? userState.dice_4 : 0,
    dice_5: userState ? userState.dice_5 : 0,
    dice_6: userState ? userState.dice_6 : 0
})

const decrement = (e) => {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value--;
    UpdateState(target.name, value)
    target.value = value;
}

const decrementPlus = (e) => {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value = value - 10;
    UpdateState(target.name, value)
    target.value = value;
}

const increment = (e) => {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value++;
    UpdateState(target.name, value)
    target.value = value;
}

const incrementPlus = (e) => {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value = value + 10;
    UpdateState(target.name, value)
    target.value = value;
}

const UpdateState = (name, value = 0) => {
    switch (name) {
        case 'input-life':
            currentStates.life = value;
            break;

        case 'input-main-magic':
            currentStates.main_magic = value;
            break;

        case 'input-secondary-magic':
            currentStates.secondary_magic = value;
            break;

        case 'input-tertiary-magic':
            currentStates.tertiary_magic = value;
            break;

        case 'input-dice-4':
            currentStates.dice_4 = value;
            break;

        case 'input-dice-5':
            currentStates.dice_5 = value;
            break;

        case 'input-dice-6':
            currentStates.dice_6 = value;
            break;

        default:
            break;
    }
}

const submitState = () => {

    axios.patch(route("userState"),currentStates)
        .then(res => {
            currentStates.id = res.data.id,
                currentStates.life = res.data.life,
                currentStates.main_magic = res.data.main_magic,
                currentStates.secondary_magic = res.data.secondary_magic,
                currentStates.tertiary_magic = res.data.tertiary_magic,
                currentStates.dice_4 = res.data.dice_4,
                currentStates.dice_5 = res.data.dice_5,
                currentStates.dice_6 = res.data.dice_6
            isOpen.value = false
        });
};

</script>

<template>
    <div>
        <div class="min-h-screen bg-dark">
            <nav class="bg-dark border-b border-dark">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex w-full">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center justify-center">
                                <Link :href="route('sheet')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-white bg-transparent" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('sheet')" :active="route().current('sheet')">
                                    Hoja
                                </NavLink>
                                <NavLink :href="route('skills')" :active="route().current('skills')">
                                    Habilidades
                                </NavLink>
                                <NavLink :href="route('inventory')" :active="route().current('inventory')">
                                    Inventario
                                </NavLink>
                                <NavLink :href="route('keepbook')" :active="route().current('keepbook')">
                                    Notas
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-dark hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->

            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <!-- Footer menu -->
            <div class="flex items-center bottom-0 fixed w-full sm:hidden">
                <div class="container" style="max-width: 100% !important;">
                    <div class="flex justify-evenly bg-muted p-2">
                        <ResponsiveNavLink type="button"
                            class="flex justify-center items-center m-1 h-9 w-9 rounded-full text-white" data-te-ripple-init
                            data-te-ripple-color="light" :href="route('sheet')" :active="route().current('sheet')">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.9688 15.8125V5.74999C17.9699 5.46649 17.915 5.18557 17.807 4.92342C17.6991 4.66128 17.5403 4.4231 17.3398 4.22264C17.1394 4.02218 16.9012 3.86339 16.6391 3.75545C16.3769 3.64751 16.096 3.59255 15.8125 3.59374H3.59375"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.34375 9.34375H15.0938" stroke="#C4C4C4" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.34375 12.2188H15.0938" stroke="#C4C4C4" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M1.98555 7.18751C1.7528 6.92691 1.58686 6.61365 1.50202 6.2747C1.41719 5.93575 1.41599 5.58126 1.49854 5.24174C1.58109 4.90223 1.74491 4.58786 1.97589 4.32569C2.20688 4.06353 2.49812 3.86143 2.82454 3.73678C3.15095 3.61213 3.50277 3.56868 3.84971 3.61016C4.19664 3.65163 4.52831 3.7768 4.81614 3.97488C5.10398 4.17296 5.33936 4.43802 5.50204 4.74725C5.66472 5.05647 5.74981 5.4006 5.75 5.75001V17.25C5.75019 17.5994 5.83528 17.9435 5.99796 18.2528C6.16064 18.562 6.39602 18.8271 6.68386 19.0251C6.97169 19.2232 7.30335 19.3484 7.65029 19.3899C7.99723 19.4313 8.34905 19.3879 8.67546 19.2632C9.00188 19.1386 9.29312 18.9365 9.52411 18.6743C9.75509 18.4122 9.91891 18.0978 10.0015 17.7583C10.084 17.4188 10.0828 17.0643 9.99798 16.7253C9.91314 16.3864 9.7472 16.0731 9.51445 15.8125H19.577C19.8545 16.1228 20.0363 16.5069 20.1004 16.9182C20.1644 17.3296 20.108 17.7507 19.9379 18.1308C19.7679 18.5108 19.4914 18.8334 19.142 19.0598C18.7926 19.2861 18.3851 19.4065 17.9688 19.4063H7.90625"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('inventory')" :active="route().current('inventory')" type="button"
                            class="flex justify-center items-center m-1 h-9 w-9 rounded-full text-white" data-te-ripple-init
                            data-te-ripple-color="light">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.625 4.3125H14.375C15.5187 4.3125 16.6156 4.76685 17.4244 5.5756C18.2331 6.38435 18.6875 7.48125 18.6875 8.625V19.4062C18.6875 19.5969 18.6118 19.7797 18.477 19.9145C18.3422 20.0493 18.1594 20.125 17.9688 20.125H5.03125C4.84063 20.125 4.65781 20.0493 4.52302 19.9145C4.38823 19.7797 4.3125 19.5969 4.3125 19.4062V8.625C4.3125 7.48125 4.76685 6.38435 5.5756 5.5756C6.38435 4.76685 7.48125 4.3125 8.625 4.3125V4.3125Z"
                                    stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M7.1875 20.125V13.6562C7.1875 13.275 7.33895 12.9094 7.60853 12.6398C7.87812 12.3702 8.24375 12.2188 8.625 12.2188H14.375C14.7562 12.2188 15.1219 12.3702 15.3915 12.6398C15.661 12.9094 15.8125 13.275 15.8125 13.6562V20.125"
                                    stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M8.625 4.3125V2.875C8.625 2.49375 8.77645 2.12812 9.04603 1.85853C9.31562 1.58895 9.68125 1.4375 10.0625 1.4375H12.9375C13.3187 1.4375 13.6844 1.58895 13.954 1.85853C14.2235 2.12812 14.375 2.49375 14.375 2.875V4.3125"
                                    stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10.0625 7.90625H12.9375" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.1875 15.0938H15.8125" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12.9375 15.0938V16.5312" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')"
                            type="button" class="flex justify-center items-center m-1 h-9 w-9 rounded-full text-white"
                            data-te-ripple-init data-te-ripple-color="light">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 15.125C13.2782 15.125 15.125 13.2782 15.125 11C15.125 8.72183 13.2782 6.875 11 6.875C8.72183 6.875 6.875 8.72183 6.875 11C6.875 13.2782 8.72183 15.125 11 15.125Z"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M15.7867 5.59454C16.0044 5.79506 16.2107 6.00131 16.4055 6.21329L18.7516 6.54845C19.1338 7.21232 19.4285 7.92292 19.6281 8.66251L18.2016 10.5617C18.2016 10.5617 18.2274 11.1461 18.2016 11.4383L19.6281 13.3375C19.4294 14.0774 19.1347 14.7881 18.7516 15.4516L16.4055 15.7867C16.4055 15.7867 16.0016 16.2078 15.7867 16.4055L15.4516 18.7516C14.7877 19.1338 14.0771 19.4285 13.3375 19.6281L11.4383 18.2016C11.1467 18.2274 10.8533 18.2274 10.5617 18.2016L8.66251 19.6281C7.92261 19.4294 7.21189 19.1347 6.54845 18.7516L6.21329 16.4055C6.00131 16.205 5.79506 15.9987 5.59454 15.7867L3.24845 15.4516C2.86618 14.7877 2.57154 14.0771 2.37189 13.3375L3.79845 11.4383C3.79845 11.4383 3.77267 10.8539 3.79845 10.5617L2.37189 8.66251C2.57062 7.92261 2.86531 7.21189 3.24845 6.54845L5.59454 6.21329C5.79506 6.00131 6.00131 5.79506 6.21329 5.59454L6.54845 3.24845C7.21232 2.86618 7.92292 2.57154 8.66251 2.37189L10.5617 3.79845C10.8533 3.77266 11.1467 3.77266 11.4383 3.79845L13.3375 2.37189C14.0774 2.57062 14.7881 2.86531 15.4516 3.24845L15.7867 5.59454Z"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('skills')" :active="route().current('skills')" type="button"
                            class="flex justify-center items-center m-1 h-9 w-9 rounded-full text-white" data-te-ripple-init
                            data-te-ripple-color="light">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.84607 11.8773L13.6742 3.61172L19.4062 3.59375L19.3883 9.32578L11.1226 16.1539"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.98438 14.0156L14.375 8.625" stroke="#C4C4C4" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M7.37616 17.7442L4.68983 20.4305C4.55509 20.5649 4.37254 20.6404 4.18222 20.6404C3.99189 20.6404 3.80934 20.5649 3.6746 20.4305L2.56952 19.3254C2.43511 19.1907 2.35962 19.0081 2.35962 18.8178C2.35962 18.6275 2.43511 18.4449 2.56952 18.3102L5.25585 15.6238C5.32376 15.557 5.37769 15.4772 5.4145 15.3893C5.45131 15.3014 5.47027 15.207 5.47027 15.1117C5.47027 15.0164 5.45131 14.9221 5.4145 14.8341C5.37769 14.7462 5.32376 14.6665 5.25585 14.5996L3.3871 12.7309C3.31919 12.664 3.26526 12.5843 3.22845 12.4964C3.19163 12.4084 3.17268 12.3141 3.17268 12.2188C3.17268 12.1234 3.19163 12.0291 3.22845 11.9412C3.26526 11.8533 3.31919 11.7735 3.3871 11.7067L4.51913 10.5746C4.58601 10.5067 4.66573 10.4528 4.75365 10.416C4.84156 10.3792 4.93593 10.3602 5.03124 10.3602C5.12655 10.3602 5.22092 10.3792 5.30883 10.416C5.39675 10.4528 5.47647 10.5067 5.54335 10.5746L12.4254 17.4567C12.4933 17.5235 12.5472 17.6033 12.584 17.6912C12.6208 17.7791 12.6398 17.8734 12.6398 17.9688C12.6398 18.0641 12.6208 18.1584 12.584 18.2464C12.5472 18.3343 12.4933 18.414 12.4254 18.4809L11.2933 19.6129C11.2265 19.6808 11.1468 19.7347 11.0588 19.7716C10.9709 19.8084 10.8766 19.8273 10.7812 19.8273C10.6859 19.8273 10.5916 19.8084 10.5036 19.7716C10.4157 19.7347 10.336 19.6808 10.2691 19.6129L8.40038 17.7442C8.3335 17.6762 8.25378 17.6223 8.16586 17.5855C8.07795 17.5487 7.98358 17.5297 7.88827 17.5297C7.79296 17.5297 7.6986 17.5487 7.61068 17.5855C7.52276 17.6223 7.44304 17.6762 7.37616 17.7442Z"
                                    stroke="#C4C4C4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('keepbook')" :active="route().current('keepbook')" type="button"
                            class="flex justify-center items-center m-1 h-9 w-9 rounded-full text-white" data-te-ripple-init
                            data-te-ripple-color="light">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 14.375H8.625V11.5L17.25 2.875L20.125 5.75L11.5 14.375Z" stroke="#F1FAEE"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.0938 5.03125L17.9688 7.90625" stroke="#F1FAEE" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M19.4062 10.7812V18.6875C19.4062 18.8781 19.3305 19.0609 19.1957 19.1957C19.0609 19.3305 18.8781 19.4062 18.6875 19.4062H4.3125C4.12188 19.4062 3.93906 19.3305 3.80427 19.1957C3.66948 19.0609 3.59375 18.8781 3.59375 18.6875V4.3125C3.59375 4.12188 3.66948 3.93906 3.80427 3.80427C3.93906 3.66948 4.12188 3.59375 4.3125 3.59375H12.2188"
                                    stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
            <!-- Slide -->
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-10">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                        enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4 text-center">
                            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                                <DialogPanel
                                    style="position: absolute;left: 0px;width: max-content;display: flex;flex-direction: column;align-items: flex-start;padding-inline-end: 7rem;"
                                    class="w-[85%] max-w-md transform overflow-hidden  rounded-2xl bg-muted p-6 text-left align-middle shadow-xl transition-all">
                                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                        <div>
                                            <h2 class="text-2xl font-bold text-warning">Current state</h2>
                                        </div>
                                    </DialogTitle>
                                    <div>
                                        <!-- Life -->
                                        <div>
                                            <p class="text-rose-500 text-lg">Life</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20  cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.life"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-life">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Main magic -->
                                        <div class="mt-3">
                                            <p class="text-cyan-500 text-lg">Main magic</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.main_magic"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-main-magic">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Secondary magic -->
                                        <div class="mt-3">
                                            <p class="text-purple-500 text-lg">Secondary magic</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.secondary_magic"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-secondary-magic">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tertiary Magic -->
                                        <div class="mt-3">
                                            <p class="text-emerald-500 text-lg">Tertiary magic</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.tertiary_magic"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-tertiary-magic">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20  cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dice 4 -->
                                        <div class="mt-3">
                                            <p class="text-gray-400 text-lg">Dice 4</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.dice_4"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-dice-4">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dice 5 -->
                                        <div class="mt-3">
                                            <p class="text-slate-300 text-lg">Dice 5</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.dice_5"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-dice-5">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dice 6 -->
                                        <div class="mt-3 mb-4">
                                            <p class="text-stone-200 text-lg">Dice 6</p>
                                            <div class="custom-number-input h-8 w-32">
                                                <div
                                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                                    <button data-action="decremenPlust" @click.prevent="decrementPlus"
                                                        class=" bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                        <span class="m-auto text-sx font-thin">−10</span>
                                                    </button>
                                                    <button data-action="decrement" @click.prevent="decrement"
                                                        class=" bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                    </button>
                                                    <input type="number" v-model="currentStates.dice_6"
                                                        class="min-w-[6rem] outline-none focus:outline-none border-transparent border-0 text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-900  outline-none"
                                                        name="input-dice-6">
                                                    <button data-action="increment" @click.prevent="increment"
                                                        class="bg-gray-100 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 cursor-pointer">
                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                    </button>
                                                    <button data-action="incrementPlus" @click.prevent="incrementPlus"
                                                        class="bg-gray-100 px-3 border-transparent border-0 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                        <span class="m-auto text-sx font-thin">+10</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex justify-between">
                                        <button type="button"
                                            class="inline-flex justify-center rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                            @click="submitState">
                                            Update
                                        </button>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
            <div class="absolute top-[55vh] left-0 inline-block">
                <button @click="openModal"
                    class="p-1 transition-all duration-500 bg-indigo-500 rounded-r-lg  peer-checked:left-[72%] sm:peer-checked:left-[25%]">
                    <img class=""
                        src="data:image/png;base64,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"
                        style="width: 2rem;">
                </button>
            </div>

        </div>
    </div>
</template>
<style>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.custom-number-input input:focus {
    outline: none !important;
}

.custom-number-input button:focus {
    outline: none !important;
}
</style>
