<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import LearningMaterialForm from './Partials/LearningMaterialForm.vue';
import { TagData } from '@/types';

defineProps<{
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Новый материал" />

    <AdminLayout>
        <template #heading>
            Новый материал
        </template>

        <LearningMaterialForm :availableTags="availableTags" />

    </AdminLayout>
</template>
