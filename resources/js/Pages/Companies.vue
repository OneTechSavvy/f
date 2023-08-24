<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Pagination.vue'

defineProps({
    companies: Object 
})
</script>

<template>
    <Head title="Companies" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table className="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th className="px-4 py-2 w-20">Logo</th>
                                    <th className="px-4 py-2">Name</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2 w-20">Website</th>
                                    <th className="px-4 py-2 w-20">Employees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="{id, name, email, logo, website} in companies.data" :key="id">
                                    <td className="border px-4 py-2"><img :src="'/storage/logo/' + logo" :alt="logo" /></td>
                                    <td className="border px-4 py-2">{{ name }}</td>
                                    <td className="border px-4 py-2">{{ email }}</td>
                                    <td className="border px-4 py-2"><Link :href="website" target="_blank" rel="noopener noreferrer">Visit</Link></td>
                                    <td className="border px-4 py-2"><Link :href="'/employees?company_id=' + id" target="_blank" rel="noopener noreferrer">View</Link></td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination class="mt-6" :links="companies.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
