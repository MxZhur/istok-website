<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import LearningMaterialForm from './Partials/LearningMaterialForm.vue';
import { LearningMaterialData, TagData } from '@/types';

defineProps<{
    item: LearningMaterialData;
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Редактировать материал" />

    <AdminLayout>
        <template #heading>
            Редактировать материал
        </template>

        <LearningMaterialForm :item="item" :availableTags="availableTags" />

    </AdminLayout>
</template>
