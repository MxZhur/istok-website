<template>
    <div v-if="links.length > 0" class="flex flex-row justify-start items-center">
        <Link :href="route('home')">
        <HomeIcon />
        </Link>
        <template v-for="link in links">
            <div class="px-3 text-gray-400">
                /
            </div>

            <template v-if="link.url">
                <Link :href="link.url">
                    <span class="text-blue-800 hover:underline cursor-pointer">
                        {{ link.title }}
                    </span>
                </Link>
            </template>
            <template v-else>
                <span>
                    {{ link.title }}
                </span>
            </template>

        </template>
    </div>
</template>

<script setup lang="ts">
import { BreadcrumbData } from '@/types';
import { Link } from '@inertiajs/vue3';
import HomeIcon from './Icons/HomeIcon.vue';

const props = defineProps<{
    links: BreadcrumbData[];
}>();
</script>
