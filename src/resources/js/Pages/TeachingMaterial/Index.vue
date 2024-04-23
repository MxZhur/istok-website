<script setup lang="ts">
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { TeachingMaterialType } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

type TypeLinkData = {
    type: TeachingMaterialType;
    name: string;
};

const links: TypeLinkData[] = [
    {
        type: 'methodological_work',
        name: 'Методическая работа',
    },
    {
        type: 'educational_work',
        name: 'Воспитательная работа',
    },
];

</script>

<template>

    <Head title="Материалы для учителей" />

    <SiteLayout>

        <template #heading>
            Материалы для учителей
        </template>

        <div>
            <MutedText>
                Выберите тип материала.
            </MutedText>

            <div v-for="link in links" class="text-2xl my-4">
                <Link :href="route('teaching_material.type', { type: link.type })">
                {{ link.name }}
                </Link>
            </div>
        </div>

    </SiteLayout>
</template>
