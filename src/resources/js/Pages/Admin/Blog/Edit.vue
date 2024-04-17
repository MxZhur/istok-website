<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import BlogPostForm from './Partials/BlogPostForm.vue';
import { BlogPostData, TagData } from '@/types';

defineProps<{
    item: BlogPostData;
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Редактировать статью" />

    <AdminLayout>
        <template #heading>
            Редактировать статью
        </template>

        <BlogPostForm :item="item" :availableTags="availableTags" />

    </AdminLayout>
</template>
