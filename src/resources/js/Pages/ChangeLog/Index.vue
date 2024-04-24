<script setup lang="ts">
import MutedText from '@/Components/MutedText.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { TeachingMaterialType } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    years: number[];
}>();

</script>

<template>

    <Head title="Журнал изменений" />

    <SiteLayout>

        <template #heading>
            Журнал изменений
        </template>

        <div>
            <MutedText>
                Для удобства информация разделена по годам. Выберите интересующий вас год.
            </MutedText>

            <div v-for="year in years" class="text-2xl my-4">
                <Link :href="route('change_log.year', { year: year })">
                {{ year }} год
                </Link>
            </div>
        </div>

    </SiteLayout>
</template>
