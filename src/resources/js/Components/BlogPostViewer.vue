<template>
    <div v-if="enableHeading" class="text-3xl">
        {{ item.title }}
    </div>
    <div class="text-right">
        <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
    </div>

    <ImageSlider :images="images" />

    <HtmlViewer :content="item.body" />

    <div class="py-4">
        <TagPill v-for="tag in item.tags" :name="tag.name" :key="tag.id" />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { BlogPostData } from '@/types';
import CreationDateTimeViewer from './CreationDateTimeViewer.vue';
import HtmlViewer from './HtmlViewer.vue';
import ImageSlider from './ImageSlider.vue';
import TagPill from './TagPill.vue';

const props = withDefaults(
    defineProps<{
        item: BlogPostData;
        enableHeading?: boolean;
    }>(),
    {
        enableHeading: true,
    }
);

const images = computed(() => {
    return props.item.storage_files.map(f => f.url);
})

</script>