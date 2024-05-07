<template>
    <form @submit.prevent="formSubmit">
        <div class="flex flex-row justify-start items-center">
            <TextInput class="flex-grow mr-2 w-32" id="search" type="text" v-model="form.q" autocomplete="search"
                placeholder="Поиск" />

            <select class="rounded-md mr-2" v-model="form.type">
                <option value="">Все типы</option>
                <option v-for="(typeTitle, typeValue) in typeValues" :value="typeValue">
                    {{ typeTitle }}
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

const typeValues = {
    'grade_9': 'Готов к ОГЭ',
    'grade_11': 'Готов к ЕГЭ',
};

const form = useForm({
    q: '',
    type: '',
});

function formSubmit() {
    form.get(route('admin.quizzes.index'), {
        preserveState: true,
    });
}

</script>
