<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { QuizItemData, QuizType } from '@/types';
import { Head } from '@inertiajs/vue3';
import QuizItem from './Partials/QuizItem.vue';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

type ItemsProp = {
    data: Array<QuizItemData>;
    links: Array<any>;
};

const props = defineProps<{
    type: QuizType;
    items: ItemsProp;
    q: string | null;
}>();

const pageTitle = computed(() => {
    switch (props.type) {
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
            title: pageTitle.value,
        }
    ];
});

</script>

<template>

    <Head :title="pageTitle" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            {{ pageTitle }}
        </template>

        <div>
            <SearchForm :searchUrl="route('quiz.type', { type: type })" :q="q" />
        </div>

        <div v-if="items.data.length > 0">
            <QuizItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
