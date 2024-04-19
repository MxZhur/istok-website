<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { BlogPostItemData } from '@/types';
import { Head } from '@inertiajs/vue3';
import BlogPostItem from './Partials/BlogPostItem.vue';
import MutedText from '@/Components/MutedText.vue';

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

    <SiteLayout>

        <template #heading>
            Блог
        </template>

        <div>
            <SearchForm searchRoute="blog.index" />
        </div>

        <div v-if="items.data.length > 0">
            <BlogPostItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
