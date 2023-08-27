<script setup>
import Input from '@/components/Input.vue';
import { ref, defineEmits } from 'vue';

const props = defineProps(['href', 'active']);
const emit = defineEmits(['search']);
console.log('[emit]', emit)
let searchTerm = ref('')
let searchTimeout;

const currentUrl = new URL(window.location.href);
const search = currentUrl.searchParams.get('search')
if(search)
    searchTerm.value = search

const performSearch = (newSearchTerm) => {
  // Clear any existing timeout
  clearTimeout(searchTimeout);

  // Set a new timeout of 3 seconds
  searchTimeout = setTimeout(() => {
    const {value} = searchTerm
    emit('update:value', value);
    emit('search', value);
  }, 1000);
};

</script>

<template>
    <Input @input="performSearch" placeholder="Search" v-model="searchTerm"/>
</template>
