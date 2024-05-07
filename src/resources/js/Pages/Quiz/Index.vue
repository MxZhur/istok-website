<script setup lang="ts">
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { QuizType } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

type TypeLinkData = {
    type: QuizType;
    name: string;
};

const links: TypeLinkData[] = [
    {
        type: 'grade_9',
        name: 'Подготовка к ОГЭ',
    },
    {
        type: 'grade_11',
        name: 'Подготовка к ЕГЭ',
    },
];

const breadcrumbs = [
    {
        title: 'Проверь себя',
    }
];

</script>

<template>

    <Head title="Проверь себя" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            Проверь себя
        </template>

        <div>
            <MutedText>
                Выберите тип теста.
            </MutedText>

            <div v-for="link in links" class="text-2xl my-4">
                <Link :href="route('quiz.type', { type: link.type })">
                {{ link.name }}
                </Link>
            </div>
        </div>

    </SiteLayout>
</template>
