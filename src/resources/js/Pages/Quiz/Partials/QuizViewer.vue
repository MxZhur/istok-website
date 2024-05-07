<template>
    <div class="text-3xl">
        {{ item.title }}
    </div>
    <div class="text-right">
        <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
    </div>

    <!-- TODO: Отображение списка вопросов и статистики -->
    <QuizQuestionViewer :questions="item.questions" />

</template>

<script setup lang="ts">
import { QuizData } from '@/types';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import QuizQuestionViewer from './QuizQuestionViewer.vue';

const props = defineProps<{
    item: QuizData;
}>();

</script>