<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { BlogPostData, CommentData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import BlogPostViewer from '@/Components/BlogPostViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { computed } from 'vue';

const props = defineProps<{
    item: BlogPostData;
    comments: CommentData[];
}>();

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Блог',
            url: route('blog.index'),
        },
        {
            title: props.item.title,
        }

    ];
});

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>
        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <BlogPostViewer :item="item" />

        <CommentTree :comments="comments" entity_type="blog_post" :entity_id="item.id" />

    </SiteLayout>
</template>
