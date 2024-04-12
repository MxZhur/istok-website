<script setup lang="ts">
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const model = defineModel<string>({ required: true });

</script>

<template>
    <QuillEditor v-model:content="model" content-type="html" toolbar="full" />
</template>
