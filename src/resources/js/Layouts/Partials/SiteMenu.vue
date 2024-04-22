<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const expanded = ref(false);

type NavLinkData = {
    title: string;
    route: string;
}

const navLinks: NavLinkData[] = [
    {
        title: 'Блог',
        route: 'blog.index',
    },
    {
        title: 'Материалы для учеников',
        route: 'learning_material.index',
    },
];

</script>

<template>
    <div class="rounded-md bg-white p-4">
        <div class="text-xs font-bold pb-4">
            Меню
        </div>
        <div>
            <div v-for="navLink in navLinks" >
                <Link :href="route(navLink.route)" :key="navLink.route">
                    {{ navLink.title }}
                </Link>
            </div>
        </div>
    </div>
</template>
