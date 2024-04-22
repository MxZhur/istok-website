<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CommentData, LearningMaterialData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import LearningMaterialViewer from './Partials/LearningMaterialViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';

const props = defineProps<{
    item: LearningMaterialData;
    comments: CommentData[];
}>();

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>
        <LearningMaterialViewer :item="item" />

        <CommentTree :comments="comments" entity_type="learning_material" :entity_id="item.id" />

    </SiteLayout>
</template>
