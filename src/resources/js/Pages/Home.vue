<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BlogPostData, BlogPostItemData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import BlogPostViewer from '@/Components/BlogPostViewer.vue';
import MutedText from '@/Components/MutedText.vue';
import BlogPostItem from './Blog/Partials/BlogPostItem.vue';

defineProps<{
    latestBlogPost: BlogPostData | null;
    otherBlogPosts: BlogPostItemData[];
}>();

</script>

<template>

    <Head title="Главная страница" />

    <SiteLayout>
        <div v-if="latestBlogPost !== null">
            <BlogPostViewer :item="latestBlogPost" />
            <div class="text-right pb-4">
                <Link :href="route('blog.show', latestBlogPost.id)">
                    На страницу статьи
                </Link>
            </div>
        </div>
        <MutedText v-else>
            На текущий момент новостей нет.
        </MutedText>

        <div v-if="otherBlogPosts.length > 0">
            <hr>
            <div class="text-lg font-bold pt-4">
                Другие статьи
            </div>

            <BlogPostItem v-for="item in otherBlogPosts" :item="item" :key="item.id" />
        </div>
    </SiteLayout>
</template>
