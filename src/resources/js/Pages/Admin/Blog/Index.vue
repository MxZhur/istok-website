<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BlogPostItem from './Partials/BlogPostItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import { TagData } from '@/types';
import BlogPostSearchForm from './Partials/BlogPostSearchForm.vue';

export type BlogPostItemData = {
    id: number;
    title: string;
    tags: Array<TagData>
    created_at: string | null;
    updated_at: string | null;
};

type ItemsProp = {
    data: Array<BlogPostItemData>;
    links: Array<any>;
};


defineProps<{
    items: ItemsProp;
}>();

</script>

<template>

    <Head title="Управление блогом" />

    <AdminLayout>
        <template #heading>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center ">
                    <div class="mr-4">
                        Управление блогом
                    </div>
                    <Link :href="route('admin.blog_posts.create')">
                    <PrimaryButton>
                        <AddIcon /> Новая статья
                    </PrimaryButton>
                    </Link>
                </div>
                <div class="flex flex-row justify-end items-center">
                    <BlogPostSearchForm />
                </div>
            </div>
        </template>

        <div>
            <div v-if="items.data.length > 0">
                <BlogPostItem v-for="item in items.data" :item="item" :key="item.id" />
                <Pagination :links="items.links" />
            </div>
            <div v-else>
                <div class="text-sm text-gray-500 italic">
                    На текущий момент здесь нет контента.
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
