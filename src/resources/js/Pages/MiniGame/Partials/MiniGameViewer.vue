<template>
    <div class="text-3xl">
        {{ item.title }}
    </div>
    <div class="text-right">
        <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
    </div>

    <HtmlViewer :content="item.body" />
</template>

<script setup lang="ts">
import { MiniGameData } from '@/types';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import HtmlViewer from '@/Components/HtmlViewer.vue';

const props = defineProps<{
    item: MiniGameData;
}>();

</script>