<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CommentData, TeachingMaterialData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import TeachingMaterialViewer from './Partials/TeachingMaterialViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';

const props = defineProps<{
    item: TeachingMaterialData;
    comments: CommentData[];
}>();

</script>

<template>

    <Head :title="item.title" />

    <SiteLayout>
        <TeachingMaterialViewer :item="item" />

        <CommentTree :comments="comments" entity_type="teaching_material" :entity_id="item.id" />

    </SiteLayout>
</template>
