<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import QuizForm from './Partials/QuizForm.vue';

</script>

<template>

    <Head title="Новый тест" />

    <AdminLayout>
        <template #heading>
            Новый тест
        </template>

        <QuizForm />

    </AdminLayout>
</template>
