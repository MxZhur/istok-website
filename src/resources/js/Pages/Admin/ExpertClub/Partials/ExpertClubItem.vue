<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('admin.expert_club.edit', item.id)">
            {{ item.title }}
            </Link>
        </div>
        <div class="flex flex-row flex-wrap">
            <TagPill v-for="tag in item.tags" :name="tag.name" :key="item.id" />
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
import TagPill from '@/Components/TagPill.vue';
import DangerButton from '@/Components/DangerButton.vue';
import CreationDateTimeViewer from '@/Components/CreationDateTimeViewer.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import { ExpertClubItemData } from '@/types';

const props = defineProps<{
    item: ExpertClubItemData;
}>();

function deleteItem() {
    if (!confirm('Вы уверены, что хотите удалить эту запись?')) {
        return;
    }

    router.delete(route('admin.expert_club.destroy', props.item.id), {
        preserveScroll: true,
        preserveState: true,
    })
}

</script>
