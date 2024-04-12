<script setup lang="ts">
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
}>();

</script>

<template>

    <Head title="Главная страница" />

    <SiteLayout>
        <div class="p-6 text-gray-500 italic">
            Это главная страница сайта. Скоро вместо этого текста появится полезная информация.
        </div>
    </SiteLayout>
</template>
