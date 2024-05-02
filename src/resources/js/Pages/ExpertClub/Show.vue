<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CommentData, ExpertClubEntryData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import ExpertClubViewer from './Partials/ExpertClubViewer.vue';
import CommentTree from '@/Components/CommentTree.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { computed } from 'vue';

const props = defineProps<{
    item: ExpertClubEntryData;
    comments: CommentData[];
}>();

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Клуб знатоков',
            url: route('expert_club.index'),
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

        <ExpertClubViewer :item="item" />

        <CommentTree :comments="comments" entity_type="expert_club" :entity_id="item.id" />

    </SiteLayout>
</template>
