<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { TeachingMaterialItemData, TeachingMaterialType } from '@/types';
import { Head } from '@inertiajs/vue3';
import TeachingMaterialItem from './Partials/TeachingMaterialItem.vue';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';

type ItemsProp = {
    data: Array<TeachingMaterialItemData>;
    links: Array<any>;
};

const props = defineProps<{
    type: TeachingMaterialType;
    items: ItemsProp;
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

</script>

<template>

    <Head :title="pageTitle" />

    <SiteLayout>

        <template #heading>
            {{ pageTitle }}
        </template>

        <div>
            <SearchForm :searchUrl="route('teaching_material.type', { type: type })" />
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