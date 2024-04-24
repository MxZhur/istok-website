<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const expanded = ref(false);

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
            title: 'Журнал изменений',
            route: 'change_log.index',
        },
    ];

    return links;
});

</script>

<template>
    <div class="rounded-md bg-white p-4">
        <div class="text-xs font-bold pb-4">
            Меню
        </div>
        <div>
            <div v-for="navLink in navLinks" class="py-2">
                <Link v-if="navLink.access !== 'teacher' || ($page.props.auth.user && $page.props.auth.user.role === 2)"
                    :href="route(navLink.route)" :key="navLink.route">
                {{ navLink.title }}
                </Link>
            </div>
        </div>
    </div>
</template>
