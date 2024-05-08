<template>
    <form @submit.prevent="formSubmit">
        <div class="flex flex-row justify-start items-center">
            <TextInput class="flex-grow mr-2 w-32" id="search" type="text" v-model="form.q"
                autocomplete="search" placeholder="Поиск" />
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

const props = defineProps<{
    searchUrl: string;
    q: string | null;
}>();

const form = useForm({
    q: props.q ?? '',
});

function formSubmit() {
    form.get(props.searchUrl, {
        preserveState: true,
    });
}

</script>
