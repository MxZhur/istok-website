<script setup lang="ts">
import AddIconBig from './Icons/AddIconBig.vue';
import CloseIcon from './Icons/CloseIcon.vue';
import TagIcon from './Icons/TagIcon.vue';

defineProps<{
    name: string;
    showAddButton?: boolean;
    showRemoveButton?: boolean;
}>();

defineEmits(['add', 'remove']);
</script>

<template>
    <div class="inline-block m-1">
        <div class="flex flex-row justify-center items-center px-3 py-1 rounded-full bg-gray-600 text-white text-sm">
            <TagIcon />&nbsp;{{ name }}
            <template v-if="showAddButton">
                &nbsp;<AddIconBig @click="$emit('add', name)" class="cursor-pointer" />
            </template>
            <template v-if="showRemoveButton">
                &nbsp;<CloseIcon @click="$emit('remove', name)" class="cursor-pointer" />
            </template>
        </div>
    </div>
</template>
