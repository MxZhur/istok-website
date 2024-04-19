<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { BlogPostData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import BlogPostViewer from '@/Components/BlogPostViewer.vue';

const props = defineProps<{
    item: BlogPostData;
}>();

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>
        <BlogPostViewer :item="item" />

        <!-- TODO: Comments -->
        <!-- <div> -->
            <!-- <div class="text-2xl"> -->
                <!-- Комментарии -->
            <!-- </div> -->
        <!-- </div> -->

    </SiteLayout>
</template>
