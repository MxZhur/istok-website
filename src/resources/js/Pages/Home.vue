<script setup lang="ts">
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
}>();

</script>

<template>

    <Head title="Главная страница" />

    <SiteLayout>
        Это главная страница сайта. Скоро вместо этого текста появится полезная информация.
    </SiteLayout>
</template>
