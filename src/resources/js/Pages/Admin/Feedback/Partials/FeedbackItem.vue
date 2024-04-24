<template>
    <div class="p-3 hover:bg-gray-100">
        <div class="text-sm font-bold inline-block">
            {{ item.user.name }} ({{ item.user.email }})
        </div>
        <div>
            <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
        </div>
        <div class="whitespace-pre-line py-2">
            {{ item.text }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { FeedbackEntryData } from '@/types';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';

const props = defineProps<{
    item: FeedbackEntryData;
}>();

</script>