<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { CommentData, FeedbackEntryData } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import CommentItem from './Comment/Partials/CommentItem.vue';
import MutedText from '@/Components/MutedText.vue';
import FeedbackItem from './Feedback/Partials/FeedbackItem.vue';

const props = defineProps<{
    latestComments: CommentData[];
    latestFeedback: FeedbackEntryData[];
}>();

</script>

<template>

    <Head title="Администраторская панель" />

    <AdminLayout>
        <template #heading>
            Администраторская панель
        </template>

        <div class="flex flex-col md:flex-row">
            <div class="md:w-4/12 w-full md:mr-4 mr-0 mb-4">
                <div class="text-lg font-bold">
                    Комментарии
                </div>

                <div>
                    <div v-if="latestComments.length > 0">
                        <CommentItem v-for="item in latestComments" :item="item" :key="item.id" />

                        <div class="text-right">
                            <Link :href="route('admin.comments.index')">
                            Больше комментариев
                            </Link>
                        </div>
                    </div>
                    <div v-else>
                        <MutedText>
                            На текущий момент здесь нет контента.
                        </MutedText>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-8/12">
                <div class="text-lg font-bold">
                    Обратная связь
                </div>

                <div>
                    <div v-if="latestFeedback.length > 0">
                        <FeedbackItem v-for="item in latestFeedback" :item="item" :key="item.id" />

                        <div class="text-right">
                            <Link :href="route('admin.feedback.index')">
                            Больше отзывов
                            </Link>
                        </div>
                    </div>
                    <div v-else>
                        <MutedText>
                            Обратную связь пока никто не давал.
                        </MutedText>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
