<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { TagData, TeachingMaterialItemData, TeachingMaterialType } from '@/types';
import { Head } from '@inertiajs/vue3';
import TeachingMaterialItem from './Partials/TeachingMaterialItem.vue';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TagCloud from '@/Components/TagCloud.vue';

type ItemsProp = {
    data: Array<TeachingMaterialItemData>;
    links: Array<any>;
};

const props = defineProps<{
    type: TeachingMaterialType;
    items: ItemsProp;
    tags: TagData[];
    q: string | null;
}>();

const pageTitle = computed(() => {
    switch (props.type) {
        case 'methodological_work':
            return 'Методическая работа';
        case 'educational_work':
            return 'Воспитательная работа';
        default:
            return '';
    }
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Материалы для учителей',
            url: route('teaching_material.index'),
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
            <SearchForm :searchUrl="route('teaching_material.type', { type: type })" :q="q" />
        </div>

        <div>
            <TagCloud :tags="tags" :searchUrl="route('teaching_material.type', { type: type })" />
        </div>

        <div v-if="items.data.length > 0">
            <TeachingMaterialItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
