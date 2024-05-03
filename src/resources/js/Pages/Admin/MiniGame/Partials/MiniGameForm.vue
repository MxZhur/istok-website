<template>
    <form @submit.prevent="formSubmit" class="space-y-6">
        <div>
            <InputLabel for="title" value="Заголовок" />

            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                autocomplete="title" placeholder="Заголовок" />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div>
            <InputLabel value="Категория" />

            <select class="rounded-md" v-model="form.category" required>
                <option v-for="(categoryTitle, categoryValue) in categoryValues" :value="categoryValue">
                    {{ categoryTitle }}
                </option>
            </select>

            <InputError class="mt-2" :message="form.errors.category" />
        </div>

        <div>
            <InputLabel for="post_body" value="I-frame код" />

            <TextInput id="mini_game_body" type="text" class="mt-1 block w-full" v-model="form.body" required placeholder="<iframe ..." />

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
import { MiniGameData } from '@/types';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const categoryValues = {
    'world_history': 'Всемирная история',
    'russia_9_13_century': 'Древняя Русь IX-XIII вв.',
    'russia_14_17_century': 'Московская Русь XIV-XVII вв.',
    'russia_18_19_century': 'Российская империя XVIII-XIX вв.',
    'russia_20_century': 'Россия и СССР: век XX',
    'russia_21_century': 'Россия: век XXI',
};

const props = defineProps<{
    item?: MiniGameData;
}>();

const form = useForm({
    _method: props.item ? 'patch' : 'post',
    title: props.item?.title ?? '',
    body: props.item?.body ?? '',
    category: props.item?.category ?? null,
});

function goBack() {
    window.history.back();
}

function formSubmit() {
    if (props.item) {
        form.post(route('admin.mini_games.update', props.item.id), {
            preserveState: true,
        });
    } else {
        form.post(route('admin.mini_games.store'), {
            preserveState: true,
        });
    }
}

</script>