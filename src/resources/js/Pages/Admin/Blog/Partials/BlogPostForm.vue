<template>
    <form @submit.prevent="formSubmit" class="space-y-6">
        <div>
            <InputLabel for="title" value="Заголовок" />

            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                autocomplete="title" placeholder="Заголовок" />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div>
            <InputLabel for="tags" value="Теги" />

            <TagInput v-model="form.tags" :availableTags="availableTagNames" />

            <InputError class="mt-2" :message="form.errors.tags" />
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
            </Transition>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { BlogPostData } from '../Edit.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TagInput from '@/Components/TagInput.vue';
import { computed } from 'vue';
import { TagData } from '../Index.vue';

const props = defineProps<{
    item?: BlogPostData;
    availableTags?: Array<TagData>;
}>();

const form = useForm({
    title: props.item?.title ?? '',
    body: props.item?.body ?? '',
    tags: props.item?.tags.map(t => t.name) ?? [],
});

const availableTagNames = computed(() => {
    return (props.availableTags ?? []).map(t => t.name);
})

function formSubmit() {
    if (props.item) {
        form.patch(route('admin.blog_posts.update', props.item.id));
    } else {
        form.post(route('admin.blog_posts.store'));
    }
}

</script>