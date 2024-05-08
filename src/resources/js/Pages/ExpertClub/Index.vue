<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { ExpertClubItemData, TagData } from '@/types';
import { Head } from '@inertiajs/vue3';
import ExpertClubItem from './Partials/ExpertClubItem.vue';
import MutedText from '@/Components/MutedText.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TagCloud from '@/Components/TagCloud.vue';

type ItemsProp = {
    data: Array<ExpertClubItemData>;
    links: Array<any>;
};

defineProps<{
    items: ItemsProp;
    tags: TagData[];
    q: string | null;
}>();

const breadcrumbs = [
    {
        title: 'Клуб знатоков',
    }
];

</script>

<template>

    <Head title="Клуб знатоков" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            Клуб знатоков
        </template>

        <div>
            <SearchForm :searchUrl="route('expert_club.index')" :q="q" />
        </div>

        <div>
            <TagCloud :tags="tags" :searchUrl="route('expert_club.index')" />
        </div>

        <div v-if="items.data.length > 0">
            <ExpertClubItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
