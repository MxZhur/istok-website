<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import CommentItem from './Partials/CommentItem.vue';
import { CommentData } from '@/types';
import CommentSearchForm from './Partials/CommentSearchForm.vue';

type ItemsProp = {
    data: Array<CommentData>;
    links: Array<any>;
};

defineProps<{
    items: ItemsProp;
}>();

</script>

<template>

    <Head title="Модерация комментариев" />

    <AdminLayout>
        <template #heading>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center ">
                    <div class="mr-4">
                        Модерация комментариев
                    </div>
                </div>
                <div class="flex flex-row justify-end items-center">
                    <CommentSearchForm />
                </div>
            </div>
        </template>

        <div>
            <div v-if="items.data.length > 0">
                <CommentItem v-for="item in items.data" :item="item" :key="item.id" />
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
