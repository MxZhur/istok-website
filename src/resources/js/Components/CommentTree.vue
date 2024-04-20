<template>
    <div>
        <div class="text-2xl">
            Комментарии
        </div>

        <div v-if="$page.props.auth.user" class="py-2">
            <CommentForm :entity_type="entity_type" :entity_id="entity_id" />
        </div>
        <div v-else>
            <MutedText>
                <Link :href="route('login')">Авторизуйтесь</Link>, чтобы оставить комментарий.
            </MutedText>
        </div>

        <div v-if="comments.length > 0">
            <CommentTreeItem v-for="comment in comments" :comment="comment" :key="comment.id"/>
        </div>
        <div v-else>
            <MutedText>
                Здесь пока нет ни одного комментария.
            </MutedText>
        </div>
    </div>
</template>

<script setup lang="ts">
import { CommentData, EntityType } from '@/types';
import MutedText from './MutedText.vue';
import CommentTreeItem from './CommentTreeItem.vue';
import CommentForm from './CommentForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    comments: CommentData[];
    entity_type: EntityType;
    entity_id: number;
}>();
</script>
