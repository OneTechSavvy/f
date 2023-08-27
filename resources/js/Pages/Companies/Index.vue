<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm  } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Pagination.vue'
import BreezeInput from '@/Components/Input.vue';

const props = defineProps({
    companies: Object
})

const form = useForm();

const destroy = (id) => {
    if (confirm("Are you sure you want to Delete?")) {
        form.delete(route('companies.destroy', id));
    }
}

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
                        <div class="flex mb-5 justify-end">
                            <Link
                                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('companies.create')"
                            >
                                + Add New
                            </Link>
                        </div>
                        <table className="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th className="px-4 py-2 w-20">Logo</th>
                                    <th className="px-4 py-2">Name</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2 w-20">Website</th>
                                    <th className="px-4 py-2 w-20">Employees</th>
                                    <th className="px-4 py-2">Manage</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="{id, name, email, logo, website} in companies.data" :key="id">
                                    <td className="px-4 py-2 break-words"><img :src="'/storage/logo/' + logo" :alt="logo" /></td>
                                    <td className="px-4 py-2 break-words">{{ name }}</td>
                                    <td className="px-4 py-2 break-words">{{ email }}</td>
                                    <td className="px-4 py-2 break-words"><Link :href="website" target="_blank" rel="noopener noreferrer">Visit</Link></td>
                                    <td className="px-4 py-2 break-words"><Link :href="'/employees?company_id=' + id" target="_blank" rel="noopener noreferrer">View</Link></td>
                                    <td className="px-4 py-4 flex justify-center gap-2">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('companies.edit', id)"
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
                        <div class="flex justify-center items-center mt-8">
                            <Pagination :links="companies.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
