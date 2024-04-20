<template>
    <div>
        <form @submit.prevent="formSubmit">
            <textarea class="w-full block rounded-md" rows="3" v-model.trim="form.text" required :placeholder="inputPlaceholder" />
            <div class="pt-1">
                <PrimaryButton type="submit" :disabled="form.processing">Отправить</PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import PrimaryButton from './PrimaryButton.vue';
import { EntityType } from '@/types';

const props = defineProps<{
    entity_type: EntityType;
    entity_id: number;
    parent_id?: number;
}>();

const form = useForm({
    entity_type: props.entity_type,
    entity_id: props.entity_id,
    parent_id: props.parent_id ?? null,
    text: '',
});

const inputPlaceholder = computed(() => {
    if (props.parent_id) {
        return 'Введите текст ответа';
    } else {
        return 'Введите текст комментария';
    }
});

function formSubmit() {
    form.post(route('comment.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
