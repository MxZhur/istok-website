<script setup lang="ts">
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { CustomPageData } from '@/types';
import { Head } from '@inertiajs/vue3';
import HtmlViewer from '@/Components/HtmlViewer.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

defineProps<{
    pageModel: CustomPageData;
}>();

const breadcrumbs = [
    {
        title: 'О себе',
    }
];

</script>

<template>

    <Head :title="pageModel.title" />

    <SiteLayout>
        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            {{ pageModel.title }}
        </template>

        <HtmlViewer :content="pageModel.body" />
    </SiteLayout>
</template>
