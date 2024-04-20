<template>
    <div class="border-t border-l pl-2 border-gray-300">
        <template v-if="!comment.is_blocked">
            <CommentViewer :comment="comment" />
    
            <div v-if="$page.props.auth.user" class="pb-2">
                <div v-if="replyFormOpen" class="pl-4">
                    <CommentForm :entity_type="comment.entity_type" :entity_id="comment.entity_id" :parent_id="comment.id" />
                </div>
    
                <div v-else>
                    <div class="text-blue-800 hover:underline cursor-pointer" @click="openReplyForm">Ответить</div>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="py-3">
                <MutedText>
                    Комментарий скрыт администратором.
                </MutedText>
            </div>
        </template>

        <div v-if="comment.children && comment.children.length > 0" class="pl-4">
            <CommentTreeItem v-for="childComment in comment.children" :comment="childComment" :key="childComment.id" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { CommentData } from '@/types';
import CommentViewer from './CommentViewer.vue';
import CommentForm from './CommentForm.vue';
import { ref } from 'vue';
import MutedText from './MutedText.vue';

const props = defineProps<{
    comment: CommentData;
}>();

const replyFormOpen = ref(false);

function openReplyForm() {
    replyFormOpen.value = true;
}
</script>
