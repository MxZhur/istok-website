<template>
    <form @submit.prevent="formSubmit">
        <div class="flex flex-row justify-start items-center">
            <TextInput class="flex-grow mr-2 w-32" id="search" type="text" v-model="form.q" autocomplete="search"
                placeholder="Поиск" />

            <select class="rounded-md mr-2" v-model="form.grade">
                <option value="">Все классы</option>
                <option v-for="(gradeTitle, gradeValue) in gradeValues" :value="gradeValue">
                    {{ gradeTitle }}
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

const gradeValues = {
    5: '5 класс',
    6: '6 класс',
    7: '7 класс',
    8: '8 класс',
    9: '9 класс',
    10: '10 класс',
    11: '11 класс',
};

const form = useForm({
    q: '',
    grade: '',
});

function formSubmit() {
    form.get(route('admin.learning_materials.index'), {
        preserveState: true,
    });
}

</script>
