<script setup>
import FlashMessageSuccess from '@/Components/FlashMessageSuccess.vue';
import FlashMessageError from '@/Components/FlashMessageError.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen bg-[#f9f9f9]">
        <nav
            class="fixed top-0 bottom-0 z-40 w-56 bg-primary-800 shadow-[0_4px_12px_-3px_rgba(0,0,0,0.3)] overflow-y-auto">
            <div class="flex flex-col min-h-screen p-4">
                <!-- Header -->
                <div class="mt-2.5 mb-6 max-h-min text-white text-center">
                    <h1
                        class="relative font-bold tracking-wider text-2xl xl:text-3xl after:content-[''] after:absolute after:-bottom-2.5 after:left-0 after:right-0 after:border-b-2 after:border-white">
                        Kumbah
                    </h1>
                </div>
                <!-- Menu -->
                <div class="mb-6 text-white text-center">
                    <ul class="space-y-1.5">
                        <li>
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard*')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="25" width="25"
                                    class="fill-current">
                                    <path
                                        d="M25.5 19.5V6H42v13.5ZM6 25.5V6h16.5v19.5ZM25.5 42V22.5H42V42ZM6 42V28.5h16.5V42Z" />
                                </svg>
                                <template #text>
                                    Dashboard
                                </template>
                            </NavLink>
                        </li>
                        <li v-if="$page.props.auth.user.isAdmin">
                            <NavLink :href="route('employee.index')" :active="route().current('employee*')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="25" width="25"
                                    class="fill-current">
                                    <path
                                        d="M0 36v-2.65q0-1.95 2.1-3.15T7.5 29q.65 0 1.2.025.55.025 1.1.125-.4.85-.6 1.725-.2.875-.2 1.875V36Zm12 0v-3.25q0-3.25 3.325-5.25t8.675-2q5.4 0 8.7 2 3.3 2 3.3 5.25V36Zm27 0v-3.25q0-1-.175-1.875t-.575-1.725q.55-.1 1.1-.125Q39.9 29 40.5 29q3.4 0 5.45 1.2Q48 31.4 48 33.35V36ZM7.5 27.5q-1.45 0-2.475-1.025Q4 25.45 4 24q0-1.45 1.025-2.475Q6.05 20.5 7.5 20.5q1.45 0 2.475 1.025Q11 22.55 11 24q0 1.45-1.025 2.475Q8.95 27.5 7.5 27.5Zm33 0q-1.45 0-2.475-1.025Q37 25.45 37 24q0-1.45 1.025-2.475Q39.05 20.5 40.5 20.5q1.45 0 2.475 1.025Q44 22.55 44 24q0 1.45-1.025 2.475Q41.95 27.5 40.5 27.5ZM24 24q-2.5 0-4.25-1.75T18 18q0-2.55 1.75-4.275Q21.5 12 24 12q2.55 0 4.275 1.725Q30 15.45 30 18q0 2.5-1.725 4.25T24 24Z" />
                                </svg>
                                <template #text>Employee</template>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('member.index')" :active="route().current('member*')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="25" width="25"
                                    class="fill-current">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
                                </svg>
                                <template #text>Member</template>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('service.index')" :active="route().current('service*')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25"
                                    class="fill-current">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM344 152c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24zm96-24c0 13.3-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zM344 408c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24zm104-24c0 13.3-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24z" />
                                </svg>
                                <template #text>Service</template>
                            </NavLink>
                        </li>
                        <li>
                            <NavLink :href="route('history')" :active="route().current('history')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" height="25" width="25"
                                    class="fill-current">
                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M224 256c-70.7 0-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128s-57.3 128-128 128zm-45.7 48h91.4c20.6 0 40.4 3.5 58.8 9.9C323 331 320 349.1 320 368c0 59.5 29.5 112.1 74.8 144H29.7C13.3 512 0 498.7 0 482.3C0 383.8 79.8 304 178.3 304zM640 368c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM496 288c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H512V304c0-8.8-7.2-16-16-16z" />
                                </svg>
                                <template #text>History</template>
                            </NavLink>
                        </li>
                    </ul>
                </div>
                <!-- account profile -->
                <div class="mt-auto text-white">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="52" height="52"
                            class="fill-current mx-auto mb-2">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256zM256 272c39.8 0 72-32.2 72-72s-32.2-72-72-72s-72 32.2-72 72s32.2 72 72 72z" />
                        </svg>
                        <div class="font-medium text-center text-sm">
                            <p>{{ $page.props.auth.user.name }}</p>
                            <p>{{ $page.props.auth.user.email }}</p>
                        </div>
                    </div>
                    <div>
                        <Link :href="route('logout')" method="post" as="button"
                            class="py-1 w-full bg-white font-medium text-center text-sm text-primary-800 rounded-md transition-transform hover:scale-105">
                        Logout
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
        <FlashMessageSuccess />
        <FlashMessageError />
        <!-- Page Content -->
        <main class="ml-auto w-[calc(100%-theme(width.56))]">
            <slot />
        </main>
    </div>
</template>
