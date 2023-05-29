<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative grid content-center justify-items-center items-top justify-center min-h-screen bg-dark dark:bg-dark sm:items-center sm:pt-0">

        <!-- https://cdn0.iconfinder.com/data/icons/fantasy/512/Fantasy_Flying_Book.png  OPEN fly-->
        <!-- https://cdn0.iconfinder.com/data/icons/fantasy/512/Fantasy_Spell_Book.png CLOSE -->
        <!-- https://cdn0.iconfinder.com/data/icons/fantasy/512/Fantasy_Open_Book.png OPEN NO FLY -->
        <ApplicationLogo class="block h-[8rem] w-auto fill-current text-white bg-transparent" />
        <div class="flex justify-center mb-8">
            <p class="text-teal-500 font-semibold">
                ROL HELPER <span class="sub-tittle">Support platform for your role-playing games</span>
            </p>
        </div>
        <div class="alignment animate-bounce" align="center"
            style="line-height:10px; display: flex; align-items: center; justify-content: center;">
            <img src="https://cdn0.iconfinder.com/data/icons/fantasy/512/Fantasy_Spell_Book.png" id="book-fly"
                style="display: block; height: auto; border: 0; width: 160px; max-width: 100%;" width="160">
        </div>
        <div>
            <div v-if="canLogin" class="hidden sm:block">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

                <template v-else>
                    <PrimaryButton :href="route('login')"  class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</PrimaryButton>

                    <PrimaryButton v-if="canRegister" :href="route('register')"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</PrimaryButton>
                </template>
            </div>
        </div>

    </div>
</template>

<style>
body {
    background: #000405;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Work Sans', sans-serif;
    font-weight: 900;
}

p {
    font-size: 8vw;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
}

.sub-tittle {
    font-size: 3vw;
    color: #fff;
    position: relative;
    white-space: nowrap;
}

.sub-tittle:after {
    --deco-height: 0.3125em;
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: calc(var(--deco-height) * -0.625);
    height: var(--deco-height);
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='64' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23a)'%3E%3Cpath d='M-17 30.5C-1 22 72-4 54 13 37.9 28.2-2.5 57.5 16 55.5s72-29 104-40' stroke='%2300FDCF' stroke-width='10'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='a'%3E%3Cpath fill='%23fff' d='M0 0h100v64H0z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A");
    background-size: auto 100%;
    background-repeat: round;
    background-position: 0em;
}

#book-fly:hover {
    content: url(https://cdn0.iconfinder.com/data/icons/fantasy/512/Fantasy_Flying_Book.png);
    height: auto;
    border: 0;
    width: 260px;
    max-width: 100%;
}
</style>

