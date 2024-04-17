<script setup lang="ts">
import { StorageFileData } from '@/types';
import FilePreviewItem from './FilePreviewItem.vue';
import { computed } from 'vue';
import AddIcon from '../Icons/AddIcon.vue';

const props = defineProps<{
    id?: string;
    existingFiles?: StorageFileData[];
    accept?: string;
}>();

const filesToDelete = defineModel<Array<string>>('filesToDelete', { default: [] });
const newFiles = defineModel<File[]>('newFiles', { default: [] });

function onFileChanged($event: Event) {
    const target = $event.target as HTMLInputElement;

    if (target.files !== null) {
        for (let i = 0; i < target.files.length; i++) {
            let file = target.files.item(i);
            if (file !== null) {
                newFiles.value.push(file);
            }
        }
    }
}

const allFiles = computed(() => {
    const result: (File | StorageFileData)[] = [
        ...(props.existingFiles ?? []).filter(f => !filesToDelete.value.includes(f.url))
    ];

    if (newFiles.value !== null) {
        for (let i = 0; i < newFiles.value.length; i++) {
            let file = newFiles.value[i];
            if (file !== null) {
                result.push(file);
            }
        }
    }

    return result;
});


function removeExistingFile(fileUrl: string) {
    filesToDelete.value.push(fileUrl);
}

function cancelNewFile(file: File) {
    newFiles.value = newFiles.value.filter(f => f !== file);
}

</script>

<template>
    <div class="flex flex-row justify-start items-center">
        <FilePreviewItem v-for="f in allFiles" :file="f" @remove-existing-file="removeExistingFile"
            @cancel-new-file="cancelNewFile" />
    </div>

    <label
        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-blue-600 tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer"
        :for="id">
        <AddIcon />&nbsp;Добавить файл(ы)
    </label>
    <input class="hidden" :id="id" type="file" multiple @change="onFileChanged($event)" :accept="accept" />
</template>
