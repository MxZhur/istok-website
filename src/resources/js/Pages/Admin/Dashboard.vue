<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Главная страница" />

    <AdminLayout>
        <template #heading>
            Главная страница
        </template>

        <div>
            <div class="text-gray-500 italic">Это главная страница администраторской панели. Скоро вместо этого
                текста
                появится различная полезная информация.</div>
        </div>
    </AdminLayout>
</template>
