<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Employee List</h2>
            </div>
            <div class="mt-20">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <div class="flex justify-end mb-5">
                        <ButtonLink :href="route('employee.add')" text="Add Employee" />
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="font-medium uppercase border-b-[3px] border-primary-800">
                                <tr>
                                    <th class="py-3 px-3.5">ID</th>
                                    <th class="py-3 px-3.5">Name</th>
                                    <th class="py-3 px-3 5">Gender</th>
                                    <th class="py-3 px-3.5">Address</th>
                                    <th class="py-3 px-3.5">Phone Number</th>
                                    <th class="py-3 px-3.5">Email</th>
                                    <th class="py-3 px-3.5">Job</th>
                                    <th class="py-3 px-3.5">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr class="group hover:bg-slate-50">
                                    <td class="py-3 px-3.5">1</td>
                                    <td class="py-3 px-3.5">Ariq Naufal</td>
                                    <td class="py-3 px-3.5">Male</td>
                                    <td class="py-3 px-3.5">Bandung</td>
                                    <td class="py-3 px-3.5">082246791678</td>
                                    <td class="py-3 px-3.5">ariqn55@gmail.com</td>
                                    <td class="py-3 px-3.5">Admin</td>
                                    <td class="py-3 px-3.5">
                                        <Link :href="route('employee.edit')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24"
                                            width="24" class="inline hover:scale-x-110">
                                            <path
                                                d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                                        </svg>
                                        </Link>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-3.5">2</td>
                                    <td class="py-3 px-3.5">Wira Mengatara</td>
                                    <td class="py-3 px-3.5">Male</td>
                                    <td class="py-3 px-3.5">Jawa tengah</td>
                                    <td class="py-3 px-3.5">082246783549</td>
                                    <td class="py-3 px-3.5">wirakun@gmail.com</td>
                                    <td class="py-3 px-3.5">Karyawan</td>
                                    <td class="py-3 px-3.5"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
