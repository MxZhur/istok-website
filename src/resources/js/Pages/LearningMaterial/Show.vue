<script setup lang="ts">
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import { CommentData, LearningMaterialData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import LearningMaterialViewer from './Partials/LearningMaterialViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps<{
    item: LearningMaterialData;
    comments: CommentData[];
}>();

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Материалы для учеников',
            url: route('learning_material.index'),
        },
        {
            title: `${props.item.grade} класс`,
            url: route('learning_material.grade', { grade: props.item.grade }),
        },
        {
            title: props.item.title,
        },
    ];
});

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <LearningMaterialViewer :item="item" />

        <CommentTree :comments="comments" entity_type="learning_material" :entity_id="item.id" />

    </SiteLayout>
</template>
