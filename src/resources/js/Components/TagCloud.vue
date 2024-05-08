<script setup lang="ts">
import { TagData } from '@/types';
import { ref } from 'vue';
import TagPill from './TagPill.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    tags: TagData[];
    searchUrl: string;
}>();

const showTags = ref<boolean>(false);

function toggleShowTags() {
    showTags.value = !showTags.value;
}

function searchByTag(tagName: string) {
    router.get(props.searchUrl, {
        q: tagName,
    });
}

</script>

<template>
    <div v-if="tags.length > 0">
        <div class="cursor-pointer" @click="toggleShowTags">
            {{ showTags ? 'Скрыть теги' : 'Показать теги' }}
        </div>
        <div v-if="showTags" class="flex flex-row flex-wrap">
            <div v-for="tag in tags" :key="tag.id" class="cursor-pointer" @click="searchByTag(tag.name)">
                <TagPill :name="tag.name" />
            </div>
        </div>
    </div>
</template>