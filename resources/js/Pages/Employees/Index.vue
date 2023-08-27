<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Pagination.vue';
import SearchInput from '@/components/SearchInput.vue';

defineProps({
    employees: Object ,
    company_id: String
})

const form = useForm();

const handleSearch = (searchTerm) => {
    form.get(route('employees.index') + "?search=" + searchTerm)
}

const destroy = (id) => {
    if (confirm("Are you sure you want to Delete?")) {
        form.delete(route('employees.destroy', id));
    }
}

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
                        <div class="flex mb-5 justify-end">
                            <Link
                                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('employees.create')"
                            >
                                + Add New
                            </Link>
                        </div>
                        <table className="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th className="px-4 py-2">Name</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2">Company</th>
                                    <th className="px-4 py-2">Phone</th>
                                    <th className="px-4 py-2">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="{id, first_name, last_name, email, company, phone} in employees.data" :key="id" className="border">
                                    <td className="px-4 py-2 break-words">{{ first_name + " " + last_name }}</td>
                                    <td className="px-4 py-2 break-words">{{ email }}</td>
                                    <td className="px-4 py-2 break-words">{{ company.name }}</td>
                                    <td className="px-4 py-2 break-words">{{ phone }}</td>
                                    <td className="px-4 py-2 break-words flex justify-center gap-2">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('employees.edit', id)"
                                        >
                                            Edit
                                        </Link>

                                        <button
                                            @click="destroy(id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center mt-8">
                            <div>
                                <SearchInput class="mt-1 block w-full" @search="handleSearch"/>
                            </div>
                            <Pagination :links="employees.links" :companyId = "company_id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
