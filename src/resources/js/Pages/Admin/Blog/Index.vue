<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BlogPostItem from './Partials/BlogPostItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import { TagData } from '@/types';

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

    <Head title="Блог" />

    <AdminLayout>
        <template #heading>
            <div class="flex flex-row justify-between">
                <div>
                    Блог
                </div>
                <div>
                    <Link :href="route('admin.blog_posts.create')">
                    <PrimaryButton>
                        <AddIcon /> Новая статья
                    </PrimaryButton>
                    </Link>
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
