<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { CommentData } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import CommentItem from './Comment/Partials/CommentItem.vue';
import MutedText from '@/Components/MutedText.vue';

const props = defineProps<{
    latestComments: CommentData[];
    // TODO: latestFeedback
}>();

</script>

<template>

    <Head title="Главная страница" />

    <AdminLayout>
        <template #heading>
            Главная страница
        </template>

        <div class="flex flex-col md:flex-row">
            <div class="md:w-4/12 w-full md:mr-4 mr-0 mb-4">
                <div class="text-3xl font-bold">
                    Комментарии
                </div>

                <div>
                    <div v-if="latestComments.length > 0">
                        <CommentItem v-for="item in latestComments" :item="item" :key="item.id" />
                    </div>
                    <div v-else>
                        <div class="text-sm text-gray-500 italic">
                            На текущий момент здесь нет контента.
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <Link :href="route('admin.comments.index')">
                    Больше комментариев
                    </Link>
                </div>
            </div>
            <div class="w-full md:w-8/12">
                <div class="text-3xl font-bold">
                    Обратная связь
                </div>
                <div>
                    <!-- TODO: Feedback -->
                    <MutedText>
                        Обратную связь пока никто не давал.
                    </MutedText>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
