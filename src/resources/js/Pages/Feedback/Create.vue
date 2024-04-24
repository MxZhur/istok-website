<script setup lang="ts">
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FeedbackForm from './Partials/FeedbackForm.vue';

</script>

<template>

    <Head title="Обратная связь" />

    <SiteLayout>

        <template #heading>
            Обратная связь
        </template>

        <div>
            <div v-if="$page.props.auth.user">
                <FeedbackForm />
            </div>
            <div v-else>
                <MutedText>
                    <Link :href="route('login')">Авторизуйтесь</Link>, чтобы оставить отзыв.
                </MutedText>
            </div>
        </div>

    </SiteLayout>
</template>
