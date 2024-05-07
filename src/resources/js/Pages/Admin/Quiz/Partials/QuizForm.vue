<template>
    <form @submit.prevent="formSubmit" class="space-y-6">
        <div>
            <InputLabel for="title" value="Заголовок" />

            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                autocomplete="title" placeholder="Заголовок" />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div>
            <InputLabel value="Тип" />

            <select class="rounded-md" v-model="form.type">
                <option v-for="(typeTitle, typeValue) in typeValues" :value="typeValue">
                    {{ typeTitle }}
                </option>
            </select>

            <InputError class="mt-2" :message="form.errors.type" />
        </div>

        <div>
            <InputLabel value="Вопросы" />

            <QuizQuestionEditor v-model="form.questions" />
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
import { QuizData } from '@/types';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import QuizQuestionEditor from './QuizQuestionEditor.vue';

const typeValues = {
    'grade_9': 'Готов к ОГЭ',
    'grade_11': 'Готов к ЕГЭ',
};

const props = defineProps<{
    item?: QuizData;
}>();

const form = useForm({
    _method: props.item ? 'patch' : 'post',
    title: props.item?.title ?? '',
    type: props.item?.type ?? null,
    questions: props.item?.questions ?? [],
});


function goBack() {
    window.history.back();
}

function formSubmit() {
    if (props.item) {
        form.post(route('admin.quizzes.update', props.item.id), {
            preserveState: true,
        });
    } else {
        form.post(route('admin.quizzes.store'), {
            preserveState: true,
        });
    }
}

</script>