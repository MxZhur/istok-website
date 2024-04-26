<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { LearningMaterialItemData } from '@/types';
import { Head } from '@inertiajs/vue3';
import LearningMaterialItem from './Partials/LearningMaterialItem.vue';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

type ItemsProp = {
    data: Array<LearningMaterialItemData>;
    links: Array<any>;
};

const props = defineProps<{
    grade: number;
    items: ItemsProp;
}>();

const pageTitle = computed(() => {
    return `Материалы для ${props.grade} класса`;
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Материалы для учеников',
            url: route('learning_material.index'),
        },
        {
            title: `${props.grade} класс`,
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
            <SearchForm :searchUrl="route('learning_material.grade', {grade: grade})" />
        </div>

        <div v-if="items.data.length > 0">
            <LearningMaterialItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
