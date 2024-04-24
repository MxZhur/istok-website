<template>
    <div>
        <form @submit.prevent="formSubmit">
            <textarea class="w-full block rounded-md" rows="3" v-model.trim="form.text" required
                placeholder="Оставьте свой отзыв о сайте администратору" />
            <div class="pt-1">
                <PrimaryButton type="submit" :disabled="form.processing">Отправить</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Отправлено.</p>
                </Transition>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    text: '',
});

function formSubmit() {
    form.post(route('feedback.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
