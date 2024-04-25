<template>
    <form @submit.prevent="formSubmit" class="space-y-6">

        <div>
            <InputLabel for="post_body" value="Содержимое" />

            <RichTextEditor id="post_body" type="text" class="mt-1 block w-full" v-model="form.body" />

            <InputError class="mt-2" :message="form.errors.body" />
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
import { useForm } from '@inertiajs/vue3';
import { CustomPageData } from '@/types';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps<{
    pageModel?: CustomPageData;
}>();

const form = useForm({
    _method: 'put',
    body: props.pageModel?.body ?? '',
});

function goBack() {
    window.history.back();
}

function formSubmit() {
    form.post(route('admin.about.update'), {
        preserveState: true,
        preserveScroll: true,
    });
}

</script>
