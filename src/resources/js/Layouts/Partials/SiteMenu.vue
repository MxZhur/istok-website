<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const expanded = ref<boolean>(false);

function toggleExpanded() {
    expanded.value = !expanded.value;
}

type NavLinkData = {
    title: string;
    route: string;
    access?: string;
}

const navLinks = computed(() => {
    let links: NavLinkData[] = [
        {
            title: 'Блог',
            route: 'blog.index',
        },
        {
            title: 'Материалы для учеников',
            route: 'learning_material.index',
        },
        {
            title: 'Материалы для учителей',
            route: 'teaching_material.index',
            access: 'teacher'
        },
        {
            title: 'Клуб знатоков',
            route: 'expert_club.index',
        },
        {
            title: 'Дидактические игры',
            route: 'mini_game.index',
        },
        {
            title: 'Журнал изменений',
            route: 'change_log.index',
        },
        {
            title: 'Обратная связь',
            route: 'feedback.create',
        },
        {
            title: 'О себе',
            route: 'about.index',
        },
    ];

    return links;
});

</script>

<template>
    <div class="rounded-md bg-white p-4">
        <div @click="toggleExpanded" class="text-xs font-bold cursor-pointer md:cursor-auto">
            Меню
        </div>
        <div class="md:block pt-4" :class="{hidden: !expanded}">
            <div v-for="navLink in navLinks" :key="navLink.route">
                <div class="py-2"
                    v-if="navLink.access !== 'teacher' || ($page.props.auth.user && $page.props.auth.user.role === 2)">
                    <Link :href="route(navLink.route)" :key="navLink.route">
                    {{ navLink.title }}
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
