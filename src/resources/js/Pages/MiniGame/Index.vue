<script setup lang="ts">
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { MiniGameCategory } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

type CategoryLinkData = {
    category: MiniGameCategory;
    name: string;
};

const links: CategoryLinkData[] = [
    {
        category: 'world_history',
        name: 'Всемирная история',
    },
    {
        category: 'russia_9_13_century',
        name: 'Древняя Русь IX-XIII вв.',
    },
    {
        category: 'russia_14_17_century',
        name: 'Московская Русь XIV-XVII вв.',
    },
    {
        category: 'russia_18_19_century',
        name: 'Российская империя XVIII-XIX вв.',
    },
    {
        category: 'russia_20_century',
        name: 'Россия и СССР: век XX',
    },
    {
        category: 'russia_21_century',
        name: 'Россия: век XXI',
    },
];

const breadcrumbs = [
    {
        title: 'Дидактические игры',
    }
];

</script>

<template>

    <Head title="Дидактические игры" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            Дидактические игры
        </template>

        <div>
            <MutedText>
                Выберите категорию.
            </MutedText>

            <div v-for="link in links" class="text-2xl my-4">
                <Link :href="route('mini_game.category', { category: link.category })">
                {{ link.name }}
                </Link>
            </div>
        </div>

    </SiteLayout>
</template>
