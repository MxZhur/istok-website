<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import AboutForm from './Partials/AboutForm.vue';
import { CustomPageData } from '@/types';

defineProps<{
    pageModel: CustomPageData;
}>();

</script>

<template>

    <Head title='Редактировать раздел "О себе"' />

    <AdminLayout>
        <template #heading>
            Редактировать раздел "О себе"
        </template>

        <AboutForm :pageModel="pageModel" />

    </AdminLayout>
</template>
