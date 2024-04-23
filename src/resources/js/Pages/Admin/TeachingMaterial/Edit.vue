<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import TeachingMaterialForm from './Partials/TeachingMaterialForm.vue';
import { TeachingMaterialData, TagData } from '@/types';

defineProps<{
    item: TeachingMaterialData;
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Редактировать материал" />

    <AdminLayout>
        <template #heading>
            Редактировать материал
        </template>

        <TeachingMaterialForm :item="item" :availableTags="availableTags" />

    </AdminLayout>
</template>
