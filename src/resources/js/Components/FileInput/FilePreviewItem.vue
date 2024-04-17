<template>
    <div class="m-2 rounded-lg border border-solid border-gray-500 p-2">
        <div class="flex flex-row justify-end items-center">
            <!-- Toolbar -->
            <CloseIcon class="cursor-pointer" @click="onRemoveClick" />
        </div>
        <div class="w-24 h-24 p-1 flex flex-column justify-center items-center" :title="fileName">
            <!-- Preview -->
            <div v-if="isImage">
                <a :href="fileUrl" target="_blank">
                    <img :src="fileUrl">
                </a>
            </div>
            <div v-else>
                <FileIcon />
                <div>{{ fileExtension }}</div>
            </div>
        </div>
        <div class="overflow-hidden truncate w-24" :title="fileName">
            {{ fileName }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { StorageFileData } from '@/types';
import { computed } from 'vue';
import FileIcon from '../Icons/FileIcon.vue';
import CloseIcon from '../Icons/CloseIcon.vue';

const props = defineProps<{
    file: File | StorageFileData;
}>();

const emit = defineEmits(['removeExistingFile', 'cancelNewFile']);

const isImage = computed(() => {
    if (props.file instanceof File) {
        return props.file.type.includes('image');
    } else {
        return props.file.type.includes('image');
    }
});

const fileName = computed(() => {
    if (props.file instanceof File) {
        return props.file.name;
    } else {
        return props.file.original_name;
    }
});

const fileExtension = computed(() => {
    if (props.file instanceof File) {
        return props.file.name.split('.').pop();
    } else {
        return props.file.original_name.split('.').pop();
    }
});

const fileUrl = computed(() => {
    if (props.file instanceof File) {
        return URL.createObjectURL(props.file);
    } else {
        return props.file.url;
    }
});

function onRemoveClick() {
    if (props.file instanceof File) {
        emit('cancelNewFile', props.file);
    } else {
        emit('removeExistingFile', props.file.url);
    }
}

</script>