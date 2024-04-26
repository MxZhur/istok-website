<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import SiteLayout from '@/Layouts/SiteLayout.vue';
import { ChangeLogEntryData } from '@/types';
import { Head } from '@inertiajs/vue3';
import MutedText from '@/Components/MutedText.vue';
import { computed } from 'vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

type ItemsProp = {
    data: Array<ChangeLogEntryData>;
    links: Array<any>;
};

const props = defineProps<{
    year: number;
    items: ItemsProp;
}>();

const pageTitle = computed(() => {
    return 'Журнал изменений за ' + props.year + ' год';
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Журнал изменений',
            url: route('change_log.index'),
        },
        {
            title: `${props.year} год`,
        }

    ];
});

function sectionName(sectionKey: string) {
    switch (sectionKey) {
        case 'blog':
            return 'Блог';
        case 'learning_materials':
            return 'Материалы для учеников';
        case 'teaching_materials':
            return 'Материалы для учителей';

        default:
            return '';
    }
}

function actionName(actionKey: string) {
    switch (actionKey) {
        case 'blog_created':
            return 'Новая запись';
        case 'blog_updated':
            return 'Запись обновлена';
        case 'blog_deleted':
            return 'Запись удалена';
        case 'learning_material_created':
            return 'Новый материал';
        case 'learning_material_updated':
            return 'Материал обновлён';
        case 'learning_material_deleted':
            return 'Материал удалён';
        case 'teaching_material_created':
            return 'Новый материал';
        case 'teaching_material_updated':
            return 'Материал обновлён';
        case 'teaching_material_deleted':
            return 'Материал удалён';

        default:
            return '';
    }
}

function entryDate(dInput: string | null) {
    if (dInput === null) {
        return '';
    }

    const d = new Date(dInput);
    return d.toLocaleDateString([], {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
    });
}

</script>

<template>

    <Head :title="pageTitle" />

    <SiteLayout>

        <template #breadcrumbs>
            <Breadcrumbs :links="breadcrumbs" />
        </template>

        <template #heading>
            {{ pageTitle }}
        </template>

        <div v-if="items.data.length > 0">
            <MutedText>
                Данные представлены в обратном хронологическом порядке — в начале показаны самые актуальные изменения.
            </MutedText>

            <table class="w-full mt-4">
                <tr>
                    <th>Раздел сайта</th>
                    <th>Событие</th>
                    <th>Название материала</th>
                    <th>Дата</th>
                </tr>
                <tr v-for="item in items.data">
                    <td>{{ sectionName(item.section) }}</td>
                    <td>{{ actionName(item.action_type) }}</td>
                    <td>
                        <a v-if="item.link_url" class="text-blue-800 hover:underline" :href="item.link_url" target="_blank">
                            {{ item.link_name }}
                        </a>
                        <span v-else>{{ item.link_name }}</span>
                    </td>
                    <td class="text-right">
                        {{ entryDate(item.created_at) }}
                    </td>
                </tr>
            </table>

            <Pagination :links="items.links" />
        </div>
        <div v-else>
            <MutedText>
                На текущий момент здесь нет контента.
            </MutedText>
        </div>
    </SiteLayout>
</template>

<style scoped>
table,
th,
td {
    border: 1px solid rgb(160, 160, 160);
    border-collapse: collapse;
}

th,
td {
    padding: 0.25rem;
}
</style>
