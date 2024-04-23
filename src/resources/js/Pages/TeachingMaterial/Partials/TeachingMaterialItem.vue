<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('teaching_material.show', {type: item.type, id: item.id})">
            {{ item.title }}
            </Link>
        </div>
        <div>
            <TagPill v-for="tag in item.tags" :name="tag.name" :key="tag.id" />
        </div>
        <div class="flex flex-row justify-between items-center">
            <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import TagPill from '@/Components/TagPill.vue';
import { TeachingMaterialItemData } from '@/types';

const props = defineProps<{
    item: TeachingMaterialItemData;
}>();

</script>
