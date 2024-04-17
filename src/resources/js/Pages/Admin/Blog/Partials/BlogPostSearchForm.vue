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

const form = useForm({
    q: '',
});

function formSubmit() {
    form.get(route('admin.blog_posts.index'), {
        preserveState: true,
    });
}

</script>
