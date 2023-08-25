<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    companies: Array
});
const companies = props.companies.data

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    company_id: null,
});

const submit = () => {
    form.post(route('employees.store'));
};

</script>

<template>
    <Head title="Company / Create" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create A New Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-blue-500 rounded-md focus:outline-none"
                                :href="route('companies.index')"
                            >
                            Back
                            </Link>
                        </div>

                        <form name="createForm" @submit.prevent="submit">
                            <div className="mb-4">

                                <BreezeLabel for="first_name" value="First Name" />

                                <BreezeInput 
                                    id="first_name" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.first_name" 
                                    autofocus />

                                <span className="text-red-600" v-if="form.errors.first_name">
                                    {{ form.errors.first_name }}
                                </span>
                            </div>

                            <div className="mb-4">

                                <BreezeLabel for="last_name" value="Last Name" />

                                <BreezeInput 
                                    id="last_name" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.last_name" 
                                    autofocus />

                                <span className="text-red-600" v-if="form.errors.last_name">
                                    {{ form.errors.last_name }}
                                </span>
                            </div>

                            <div className="mb-4">

                                <BreezeLabel for="email" value="Email" />

                                <BreezeInput 
                                    id="email" 
                                    type="email" 
                                    class="mt-1 block w-full" 
                                    v-model="form.email" 
                                    autofocus />

                                <span className="text-red-600" v-if="form.errors.email">
                                    {{ form.errors.email }}
                                </span>
                            </div>

                            <div className="mb-4">

                                <BreezeLabel for="phone" value="Phone Number" />

                                <BreezeInput 
                                    id="phone" 
                                    type="tel" 
                                    class="mt-1 block w-full" 
                                    v-model="form.phone" 
                                    autofocus />

                                <span className="text-red-600" v-if="form.errors.phone">
                                    {{ form.errors.phone }}
                                </span>
                            </div>

                            <div className="mb-4">

                                <BreezeLabel for="company" value="Company" />

                                <select v-model="form.company_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                    <option v-for="(company, key) in companies" :key="key" :value="company.id" :selected = "company.id == form.company_id" >
                                        {{ company.name }}
                                    </option>

                                </select>

                                <span className="text-red-600" v-if="form.errors.company_id">
                                    {{ form.errors.company_id }}
                                </span>
                            </div>

                            <div className="mt-4">
                                <button
                                    type="submit"
                                    className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                >
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>