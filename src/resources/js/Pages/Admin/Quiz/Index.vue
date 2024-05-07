<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import QuizItem from './Partials/QuizItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import { QuizItemData } from '@/types';
import QuizSearchForm from './Partials/QuizSearchForm.vue';

type ItemsProp = {
    data: Array<QuizItemData>;
    links: Array<any>;
};

defineProps<{
    items: ItemsProp;
}>();

</script>

<template>

    <Head title="Управление тестами" />

    <AdminLayout>
        <template #heading>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center ">
                    <div class="mr-4">
                        Управление тестами
                    </div>
                    <Link :href="route('admin.quizzes.create')">
                    <PrimaryButton>
                        <AddIcon /> Новый тест
                    </PrimaryButton>
                    </Link>
                </div>
                <div class="flex flex-row justify-end items-center">
                    <QuizSearchForm />
                </div>
            </div>
        </template>

        <div>
            <div v-if="items.data.length > 0">
                <QuizItem v-for="item in items.data" :item="item" :key="item.id" />
                <Pagination :links="items.links" />
            </div>
            <div v-else>
                <div class="text-sm text-gray-500 italic">
                    На текущий момент здесь нет контента.
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
