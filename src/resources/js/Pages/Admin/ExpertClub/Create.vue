<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ExpertClubForm from './Partials/ExpertClubForm.vue';
import { TagData } from '@/types';

defineProps<{
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Новая запись" />

    <AdminLayout>
        <template #heading>
            Новая запись
        </template>

        <ExpertClubForm :availableTags="availableTags" />

    </AdminLayout>
</template>
