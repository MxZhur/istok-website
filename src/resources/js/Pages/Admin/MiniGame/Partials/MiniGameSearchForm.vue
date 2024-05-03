<template>
    <form @submit.prevent="formSubmit">
        <div class="flex flex-row justify-start items-center">
            <TextInput class="flex-grow mr-2 w-32" id="search" type="text" v-model="form.q" autocomplete="search"
                placeholder="Поиск" />

            <select class="rounded-md mr-2" v-model="form.category">
                <option value="">Все типы</option>
                <option v-for="(categoryTitle, categoryValue) in categoryValues" :value="categoryValue">
                    {{ categoryTitle }}
                </option>
            </select>
            <PrimaryButton>
                <SearchIcon />
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SearchIcon from '@/Components/Icons/SearchIcon.vue';

const categoryValues = {
    'world_history': 'Всемирная история',
    'russia_9_13_century': 'Древняя Русь IX-XIII вв.',
    'russia_14_17_century': 'Московская Русь XIV-XVII вв.',
    'russia_18_19_century': 'Российская империя XVIII-XIX вв.',
    'russia_20_century': 'Россия и СССР: век XX',
    'russia_21_century': 'Россия: век XXI',
};

const form = useForm({
    q: '',
    category: '',
});

function formSubmit() {
    form.get(route('admin.mini_games.index'), {
        preserveState: true,
    });
}

</script>
