<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('admin.blog_posts.edit', item.id)">
            {{ item.title }}
            </Link>
        </div>
        <div>
            <TagPill v-for="tag in item.tags" :name="tag.name" />
        </div>
        <div class="text-gray-600 text-sm text-right">
            {{ item.created_at }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BlogPostItemData } from '../Index.vue';
import TagPill from '@/Components/TagPill.vue';

defineProps<{
    item: BlogPostItemData;
}>();
</script>