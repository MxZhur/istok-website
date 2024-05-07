<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('admin.quizzes.edit', item.id)">
            {{ item.title }}
            </Link>
        </div>
        <div>
            {{ materialTypeName }}
        </div>

        <div class="flex flex-row justify-between items-center">
            <CreationDateTimeViewer :created_at="item.created_at" :updated_at="item.updated_at" />
            <div>
                <DangerButton @click="deleteItem" title="Удалить">
                    <TrashIcon />
                </DangerButton>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import { QuizItemData } from '@/types';
import { computed } from 'vue';

const props = defineProps<{
    item: QuizItemData;
}>();

function deleteItem() {
    if (!confirm('Вы уверены, что хотите удалить этот материал?')) {
        return;
    }

    router.delete(route('admin.quizzes.destroy', props.item.id), {
        preserveScroll: true,
        preserveState: true,
    })
}

const materialTypeName = computed(() => {
    switch (props.item.type) {
        case 'grade_9':
            return 'Готов к ОГЭ';
        case 'grade_11':
            return 'Готов к ЕГЭ';
        default:
            return '';
    }
});

</script>