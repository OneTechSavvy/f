<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Pagination.vue'

defineProps({
    employees: Object ,
    company_id: String
})
</script>

<template>
    <Head title="Employees" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employees
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table className="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th className="px-4 py-2">Name</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2">Company</th>
                                    <th className="px-4 py-2">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="{id, first_name, last_name, email, company, phone} in employees.data" :key="id">
                                    <td className="border px-4 py-2">{{ first_name + " " + last_name }}</td>
                                    <td className="border px-4 py-2">{{ email }}</td>
                                    <td className="border px-4 py-2">{{ company.name }}</td>
                                    <td className="border px-4 py-2">{{ phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination class="mt-6" :links="employees.links" :companyId = "company_id" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
