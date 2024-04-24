<template>
    <div class="p-4 hover:bg-gray-100">
        <CommentViewer :comment="item" />
        <div v-if="!item.is_blocked" class="inline-block text-red-600 cursor-pointer" @click="blockItem" title="Заблокировать комментарий">
            Скрыть
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { CommentData } from '@/types';
import CommentViewer from '@/Components/CommentViewer.vue';

const props = defineProps<{
    item: CommentData;
}>();

function blockItem() {
    if (!confirm('Вы уверены, что хотите скрыть этот комментарий?')) {
        return;
    }

    router.put(route('admin.comments.block', props.item.id), {
        preserveScroll: true,
        preserveState: true,
    })
}
</script>