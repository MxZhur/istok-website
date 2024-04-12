<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import BlogPostForm from './Partials/BlogPostForm.vue';
import { TagData } from './Index.vue';

defineProps<{
    availableTags: TagData[];
}>();

</script>

<template>

    <Head title="Новая статья" />

    <AdminLayout>
        <template #heading>
            Новая статья
        </template>

        <BlogPostForm :availableTags="availableTags" />

    </AdminLayout>
</template>
