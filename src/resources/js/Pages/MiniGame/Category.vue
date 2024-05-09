<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { MiniGameCategory, MiniGameItemData } from '@/types';
import { Head } from '@inertiajs/vue3';
import MiniGameItem from './Partials/MiniGameItem.vue';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

type ItemsProp = {
    data: Array<MiniGameItemData>;
    links: Array<any>;
};

const props = defineProps<{
    category: MiniGameCategory;
    items: ItemsProp;
    q: string | null;
}>();

const pageTitle = computed(() => {
    switch (props.category) {
        case 'world_history':
            return 'Всемирная история';
        case 'russia_9_13_century':
            return 'Древняя Русь IX-XIII вв.';
        case 'russia_14_17_century':
            return 'Московская Русь XIV-XVII вв.';
        case 'russia_18_19_century':
            return 'Российская империя XVIII-XIX вв.';
        case 'russia_20_century':
            return 'Россия и СССР: век XX';
        case 'russia_21_century':
            return 'Россия: век XXI';
        default:
            return '';
    }
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Дидактические игры',
            url: route('mini_game.index'),
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
            <SearchForm :searchUrl="route('mini_game.category', { category: category })" :q="q" />
        </div>

        <div v-if="items.data.length > 0">
            <MiniGameItem v-for="item in items.data" :item="item" :key="item.id" />
            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>
