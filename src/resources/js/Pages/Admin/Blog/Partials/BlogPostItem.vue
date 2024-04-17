<template>
    <div class="p-4 hover:bg-gray-100">
        <div class="text-xl">
            <Link :href="route('admin.blog_posts.edit', item.id)">
            {{ item.title }}
            </Link>
        </div>
        <div>
            <TagPill v-for="tag in item.tags" :name="tag.name" />
        </div>
        <div class="flex flex-row justify-between items-center">
            <div class="text-gray-600 text-sm">
                {{ item.created_at }}
                <template v-if="item.updated_at !== null && item.updated_at !== item.created_at">
                    &nbsp; (ред. {{ item.updated_at }})
                </template>
            </div>
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
import { BlogPostItemData } from '../Index.vue';
import TagPill from '@/Components/TagPill.vue';
import DangerButton from '@/Components/DangerButton.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';

const props = defineProps<{
    item: BlogPostItemData;
}>();

function deleteItem() {
    if (!confirm('Вы уверены, что хотите удалить эту запись?')) {
        return;
    }

    router.delete(route('admin.blog_posts.destroy', props.item.id), {
        preserveScroll: true,
        preserveState: true,
    })
}
</script>