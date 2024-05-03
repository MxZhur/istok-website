<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('admin.mini_games.edit', item.id)">
            {{ item.title }}
            </Link>
        </div>
        <div>
            {{ miniGameCategoryName }}
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
import { MiniGameItemData } from '@/types';
import { computed } from 'vue';

const props = defineProps<{
    item: MiniGameItemData;
}>();

function deleteItem() {
    if (!confirm('Вы уверены, что хотите удалить этот материал?')) {
        return;
    }

    router.delete(route('admin.mini_games.destroy', props.item.id), {
        preserveScroll: true,
        preserveState: true,
    })
}

const miniGameCategoryName = computed(() => {
    switch (props.item.category) {
        case 'world_history':
            return 'Всемирная история';
        case 'russia_9_13_century':
            return 'Древняя Русь IX-XIII вв.';
        case 'russia_14_17_century':
            return 'Московская Русь XIV-XVII вв.';
        case 'russia_18_19_century':
            return 'Российская империя XVIII-XIX вв.';
        case 'russia_20_century':
            return 'Россия и СССР: век XX';
        case 'russia_21_century':
            return 'Россия: век XXI';
        default:
            return '';
    }
});

</script>