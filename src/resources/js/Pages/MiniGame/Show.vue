<script setup lang="ts">
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import { MiniGameData } from '@/types';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import MiniGameViewer from './Partials/MiniGameViewer.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps<{
    item: MiniGameData;
}>();

const itemCategoryName = computed(() => {
    switch (props.item.category) {
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
            title: itemCategoryName.value,
            url: route('mini_game.category', {category: props.item.category}),
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

        <MiniGameViewer :item="item" />

    </SiteLayout>
</template>
