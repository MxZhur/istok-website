<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import FeedbackItem from './Partials/FeedbackItem.vue';
import { FeedbackEntryData } from '@/types';
import FeedbackSearchForm from './Partials/FeedbackSearchForm.vue';

type ItemsProp = {
    data: Array<FeedbackEntryData>;
    links: Array<any>;
};

defineProps<{
    items: ItemsProp;
}>();

</script>

<template>

    <Head title="Обратная связь" />

    <AdminLayout>
        <template #heading>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center ">
                    <div class="mr-4">
                        Обратная связь
                    </div>
                </div>
                <div class="flex flex-row justify-end items-center">
                    <FeedbackSearchForm />
                </div>
            </div>
        </template>

        <div>
            <div v-if="items.data.length > 0">
                <FeedbackItem v-for="item in items.data" :item="item" :key="item.id" />
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
