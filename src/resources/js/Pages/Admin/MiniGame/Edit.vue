<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import MiniGameForm from './Partials/MiniGameForm.vue';
import { MiniGameData } from '@/types';

defineProps<{
    item: MiniGameData;
}>();

</script>

<template>

    <Head title="Редактировать игру" />

    <AdminLayout>
        <template #heading>
            Редактировать игру
        </template>

        <MiniGameForm :item="item" />

    </AdminLayout>
</template>
