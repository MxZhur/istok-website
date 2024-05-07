<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import QuizForm from './Partials/QuizForm.vue';
import { QuizData } from '@/types';

defineProps<{
    item: QuizData;
}>();

</script>

<template>

    <Head title="Редактировать тест" />

    <AdminLayout>
        <template #heading>
            Редактировать тест
        </template>

        <QuizForm :item="item" />

    </AdminLayout>
</template>
