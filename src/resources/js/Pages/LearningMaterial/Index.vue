<script setup lang="ts">
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

type GradeLinkData = {
    grade: number;
    subtitle?: string;
};

const links: GradeLinkData[] = [
    {
        grade: 5,
    },
    {
        grade: 6,
    },
    {
        grade: 7,
    },
    {
        grade: 8,
    },
    {
        grade: 9,
    },
    {
        grade: 10,
    },
    {
        grade: 11,
    },
];

const breadcrumbs = [
    {
        title: 'Материалы для учеников',
    }
];

</script>

<template>

    <Head title="Материалы для учеников" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            Материалы для учеников
        </template>

        <div>
            <MutedText>
                Выберите класс, для которого хотите просмотреть материалы.
            </MutedText>

            <div v-for="link in links" class="text-2xl my-4">
                <Link :href="route('learning_material.grade', { grade: link.grade })">
                {{ link.grade }} класс <span v-if="link.subtitle !== undefined">({{ link.subtitle }})</span>
                </Link>
            </div>
        </div>

    </SiteLayout>
</template>
