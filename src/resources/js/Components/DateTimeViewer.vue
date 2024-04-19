<template>
    {{ convertedValue }}
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    value: string | null;
}>();

const convertedValue = computed(() => {
    if (props.value === null) {
        return '';
    }

    const d = new Date(props.value);
    return d.toLocaleTimeString([], {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
});
</script>
