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
];

</script>

<template>
    <div class="rounded-md bg-white p-4">
        <div class="text-xs font-bold">
            Меню
        </div>
        <div>
            <Link v-for="navLink in navLinks" :href="route(navLink.route)">
                {{ navLink.title }}
            </Link>
        </div>
    </div>
</template>
