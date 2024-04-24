<template>
    <div class="py-3" :class="{'line-through': comment.is_blocked}">
        <div class="text-sm font-bold inline-block">
            {{ comment.user.name }}
        </div>
        &nbsp;
        <div class="inline-block">
            <CreationDateTimeViewer :created_at="comment.created_at" :updated_at="comment.updated_at" />
        </div>
        <div class="whitespace-pre-line">
            {{ comment.text }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { CommentData } from '@/types';
import CreationDateTimeViewer from './CreationDateTimeViewer.vue';

const props = defineProps<{
    comment: CommentData;
}>();
</script>
