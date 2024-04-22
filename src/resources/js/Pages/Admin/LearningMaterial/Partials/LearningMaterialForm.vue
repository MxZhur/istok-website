<template>
    <form @submit.prevent="formSubmit" class="space-y-6">
        <div>
            <InputLabel for="title" value="Заголовок" />

            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                autocomplete="title" placeholder="Заголовок" />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div>
            <InputLabel for="post_body" value="Содержимое" />

            <RichTextEditor id="post_body" type="text" class="mt-1 block w-full" v-model="form.body" />

            <InputError class="mt-2" :message="form.errors.body" />
        </div>

        <div>
            <InputLabel value="Класс" />

            <select class="rounded-md" v-model="form.grade">
                <option v-for="(gradeTitle, gradeValue) in gradeValues" :value="gradeValue">
                    {{ gradeTitle }}
                </option>
            </select>

            <InputError class="mt-2" :message="form.errors.grade" />
        </div>

        <div>
            <InputLabel for="tags" value="Теги" />

            <TagInput v-model="form.tags" :availableTags="availableTagNames" />

            <InputError class="mt-2" :message="form.errors.tags" />
        </div>

        <div>
            <InputLabel for="tags" value="Файлы" />

            <FileInput id="blog_post_files" accept="*/*" :existingFiles="item?.storage_files"
                v-model:files-to-delete="form.filesToDelete" v-model:new-files="form.newFiles" />

            <InputError class="mt-2" :message="form.errors.newFiles" />
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>
            <SecondaryButton @click.prevent="goBack" :disabled="form.processing">Отмена</SecondaryButton>

            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
            </Transition>
        </div>
    </form>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { LearningMaterialData, TagData } from '@/types';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TagInput from '@/Components/TagInput.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import FileInput from '@/Components/FileInput/FileInput.vue';

const gradeValues = {
    5: '5 класс',
    6: '6 класс',
    7: '7 класс',
    8: '8 класс',
    9: '9 класс',
    10: '10 класс',
    11: '11 класс',
};

const props = defineProps<{
    item?: LearningMaterialData;
    availableTags?: Array<TagData>;
}>();

const form = useForm({
    _method: props.item ? 'patch' : 'post',
    title: props.item?.title ?? '',
    body: props.item?.body ?? '',
    grade: props.item?.grade ?? null,
    tags: props.item?.tags.map(t => t.name) ?? [],
    filesToDelete: [],
    newFiles: <File[]>[],
});

const availableTagNames = computed(() => {
    return (props.availableTags ?? []).map(t => t.name);
});

function goBack() {
    window.history.back();
}

function formSubmit() {
    if (props.item) {
        form.post(route('admin.learning_materials.update', props.item.id), {
            preserveState: true,
        });
    } else {
        form.post(route('admin.learning_materials.store'), {
            preserveState: true,
        });
    }
}

</script>