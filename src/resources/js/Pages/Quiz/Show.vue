<script setup lang="ts">
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import { QuizData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import QuizViewer from './Partials/QuizViewer.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps<{
    item: QuizData;
}>();

const itemTypeName = computed(() => {
    switch (props.item.type) {
        case 'grade_9':
            return 'Подготовка к ОГЭ';
        case 'grade_11':
            return 'Подготовка к ЕГЭ';
        default:
            return '';
    }
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Проверь себя',
            url: route('quiz.index'),
        },
        {
            title: itemTypeName.value,
            url: route('quiz.type', {type: props.item.type}),
        },
        {
            title: props.item.title,
        }
    ];
});

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <QuizViewer :item="item" />

    </SiteLayout>
</template>
