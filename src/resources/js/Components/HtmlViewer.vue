<template>
    <div v-html="content"></div>
</template>

<script setup lang="ts">
defineProps<{
    content: string;
}>();
</script>

<style>
.ql-size-huge,
span.ql-size-huge,
p.ql-size-huge {
    font-size: 2rem;
}

.ql-size-large,
span.ql-size-large,
p.ql-size-large {
    font-size: 1.5rem;

}

.ql-size-small,
span.ql-size-small,
p.ql-size-small {
    font-size: 0.75rem;
}
</style>
