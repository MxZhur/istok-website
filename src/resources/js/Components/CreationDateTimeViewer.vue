<template>
    <div class="text-gray-600 text-sm">
        <DateTimeViewer :value="created_at" />
        <template v-if="updated_at !== undefined && displayUpdatedAt">
            <span class="text-gray-400 italic">
                (ред. <DateTimeViewer :value="updated_at" />)
            </span>
        </template>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import DateTimeViewer from './DateTimeViewer.vue';

const props = defineProps<{
    created_at: string | null;
    updated_at?: string | null;
}>();

const displayUpdatedAt = computed(() => {
    return props.updated_at !== null && props.updated_at !== props.created_at;
})

</script>
