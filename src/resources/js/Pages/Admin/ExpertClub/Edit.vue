<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ExpertClubForm from './Partials/ExpertClubForm.vue';
import { BlogPostData, TagData } from '@/types';

defineProps<{
    item: BlogPostData;
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Редактировать запись" />

    <AdminLayout>
        <template #heading>
            Редактировать запись
        </template>

        <ExpertClubForm :item="item" :availableTags="availableTags" />

    </AdminLayout>
</template>
