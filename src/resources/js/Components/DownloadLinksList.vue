<template>
    <div v-if="files.length > 0">
        <div class="text-lg font-bold pb-2">
            Скачать файлы
        </div>

        <ul>
            <li v-for="file in files" class="py-2">
                <a :href="route('file.download', file.id)">
                    <FileIcon class="inline-block" /> {{ file.original_name }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { StorageFileData } from '@/types';
import FileIcon from './Icons/FileIcon.vue';

const props = defineProps<{
    files: StorageFileData[];
}>();

</script>