<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { BlogPostData, CommentData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import BlogPostViewer from '@/Components/BlogPostViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';

const props = defineProps<{
    item: BlogPostData;
    comments: CommentData[];
}>();

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>
        <BlogPostViewer :item="item" />

        <!-- TODO: Comments -->
        <CommentTree :comments="comments" entity_type="blog_post" :entity_id="item.id" />

    </SiteLayout>
</template>
