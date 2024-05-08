<template>
    <div class="text-3xl">
        {{ item.title }}
    </div>
    <div class="text-right">
        <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
    </div>

    <div>
        Материал для {{ item.grade }} класса
    </div>

    <HtmlViewer :content="item.body" />

    <DownloadLinksList :files="item.storage_files" />

    <div class="py-4 flex flex-row flex-wrap">
        <TagPill v-for="tag in item.tags" :name="tag.name" :key="tag.id" />
    </div>
</template>

<script setup lang="ts">
import { LearningMaterialData } from '@/types';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import HtmlViewer from '@/Components/HtmlViewer.vue';
import TagPill from '@/Components/TagPill.vue';
import DownloadLinksList from '@/Components/DownloadLinksList.vue';

const props = defineProps<{
    item: LearningMaterialData;
}>();

</script>