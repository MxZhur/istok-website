<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { CustomPageData } from '@/types';
import { Head } from '@inertiajs/vue3';
import MutedText from '@/Components/MutedText.vue';
import HtmlViewer from '@/Components/HtmlViewer.vue';

defineProps<{
    pageModel: CustomPageData;
}>();

</script>

<template>

    <Head :title="pageModel.title" />

    <SiteLayout>

        <template #heading>
            {{ pageModel.title }}
        </template>

        <HtmlViewer :content="pageModel.body" />
    </SiteLayout>
</template>
