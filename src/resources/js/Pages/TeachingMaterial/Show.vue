<script setup lang="ts">
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import { CommentData, TeachingMaterialData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import TeachingMaterialViewer from './Partials/TeachingMaterialViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps<{
    item: TeachingMaterialData;
    comments: CommentData[];
}>();

const itemTypeName = computed(() => {
    switch (props.item.type) {
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
            title: itemTypeName.value,
            url: route('teaching_material.type', {type: props.item.type}),
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

        <TeachingMaterialViewer :item="item" />

        <CommentTree :comments="comments" entity_type="teaching_material" :entity_id="item.id" />

    </SiteLayout>
</template>
