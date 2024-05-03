<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import MiniGameForm from './Partials/MiniGameForm.vue';

</script>

<template>

    <Head title="Новая игра" />

    <AdminLayout>
        <template #heading>
            Новая игра
        </template>

        <MiniGameForm />

    </AdminLayout>
</template>
