<script setup lang="ts">
import { computed, ref } from 'vue';
import TextInput from './TextInput.vue';
import TagPill from './TagPill.vue';

const model = defineModel<string[]>({ required: true, default: [] });

const props = defineProps<{
    availableTags: Array<string>;
}>();

function addTag() {
    const text = newTagText.value.trim();

    if (!model.value.includes(text)) {
        model.value.push(text);
    }
    newTagText.value = '';
}

function addExistingTag(tag: string) {
    if (!model.value.includes(tag)) {
        model.value.push(tag);
    }

    newTagText.value = '';
}

function removeTag(deletedTag: string) {
    model.value = model.value.filter(t => t !== deletedTag);
    if (!model.value.includes(newTagText.value)) {
    }
    newTagText.value = '';
}

const newTagText = ref('');

const foundTags = computed(() => {
    const text = newTagText.value.trim();
    if (text.length === 0) {
        return [];
    }
    return props.availableTags.filter(t => t.includes(text));
});

</script>

<template>
    <div>
        <div>
            <TagPill v-for="tag in model" :name="tag" :showRemoveButton="true" @remove="removeTag(tag)" />
        </div>
        <TextInput @keydown.enter.prevent="addTag" class="mt-1 block w-full" placeholder="Введите тег и нажмите Enter"
            v-model="newTagText" />
        <div v-if="foundTags.length > 0">
            <div>Существующие теги</div>
            <div>
                <TagPill v-for="tag in foundTags" :name="tag" :showAddButton="true" @add="addExistingTag(tag)" />
            </div>
        </div>
    </div>
</template>