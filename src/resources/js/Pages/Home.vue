<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BlogPostData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import BlogPostViewer from '@/Components/BlogPostViewer.vue';
import MutedText from '@/Components/MutedText.vue';

defineProps<{
    latestBlogPost: BlogPostData | null;
}>();

</script>

<template>

    <Head title="Главная страница" />

    <SiteLayout>
        <div v-if="latestBlogPost !== null">
            <BlogPostViewer :item="latestBlogPost" />
            <div class="text-right">
                <Link :href="route('blog.show', latestBlogPost.id)">
                    На страницу статьи
                </Link>
            </div>
        </div>
        <MutedText v-else>
            На текущий момент новостей нет.
        </MutedText>
    </SiteLayout>
</template>
