<script setup lang="ts">
import { ref } from 'vue';
import { nanoid } from 'nanoid';
import { QuizQuestionData } from '@/types';
import Checkbox from '@/Components/Checkbox.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AddIconBig from '@/Components/Icons/AddIconBig.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MutedText from '@/Components/MutedText.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const model = defineModel<QuizQuestionData[]>({ required: true });

const selectedQuestion = ref<string | null>(null);

function addQuestion() {
    const newQuestionId = nanoid();

    model.value.push({
        id: newQuestionId,
        body: '',
        answerType: 'pick_single',
        answers: [],
        correctAnswers: [],
        maxPoints: 1,
        allowPartiallyCorrectAnswers: true,
        requireAscendingOrder: true,
    });

    selectedQuestion.value = newQuestionId;
}

function removeQuestion(qId: string) {
    model.value = model.value.filter(q => q.id !== qId);

    selectedQuestion.value = null;
}

function selectQuestion(qId: string) {
    selectedQuestion.value = qId;
}

function addAnswer(qIndex: number) {
    model.value[qIndex].answers.push({
        id: nanoid(),
        name: '',
    });
}

function resetAnswers(qIndex: number) {
    model.value[qIndex].answers = [];
    model.value[qIndex].correctAnswers = [];
}

function removeAnswer(qIndex: number, answerId: string) {
    model.value[qIndex].answers = model.value[qIndex].answers.filter(a => a.id !== answerId);
}

function toggleCorrectAnswer(qIndex: number, answerId: string) {
    if (model.value[qIndex].correctAnswers.includes(answerId)) {
        model.value[qIndex].correctAnswers = model.value[qIndex].correctAnswers.filter(a => a !== answerId);
    } else {
        model.value[qIndex].correctAnswers.push(answerId);
    }
}

function addCorrectAnswer(qIndex: number) {
    model.value[qIndex].correctAnswers.push('');
}

function removeCorrectAnswer(qIndex: number, answerIndex: number) {
    model.value[qIndex].correctAnswers.splice(answerIndex, 1);
}

const answerTypeValues = {
    "pick_single": "Выбор одного варианта",
    "pick_multiple": "Выбор нескольких вариантов",
    "number_sequence": "Ввод последовательности чисел",
    "custom_text": "Ввод произвольного текста",
}

</script>

<template>
    <div class="w-full min-h-32 flex flex-row items-start">
        <div class="flex-0 p-4 border-r flex flex-col justify-start items-stretch border-gray-400">
            <div v-for="(question, index) in model" class="px-2 py-1 flex flex-row justify-between items-center"
                :class="{ btnSelected: question.id === selectedQuestion }">
                <div class="cursor-pointer mr-4" @click="selectQuestion(question.id)">
                    Вопрос №{{ index + 1 }}
                </div>
                <div>
                    <DangerButton title="Удалить" @click.prevent="removeQuestion(question.id)">
                        <TrashIcon />
                    </DangerButton>
                </div>
            </div>
            <SecondaryButton @click.prevent="addQuestion">
                <AddIconBig /> Добавить
            </SecondaryButton>
        </div>
        <div class="flex-1 p-4">
            <div v-if="selectedQuestion === null">
                <MutedText>
                    Пожалуйста, выберите вопрос или добавьте новый.
                </MutedText>
            </div>
            <div v-else>
                <template v-for="(question, index) in model" :key="index">
                    <template v-if="model[index].id === selectedQuestion">
                        <div class="text-2xl">
                            Вопрос №{{ index + 1 }}
                        </div>

                        <div class="block mt-4">
                            <InputLabel for="question_body" value="Текст вопроса" />

                            <RichTextEditor id="question_body" class="mt-1 block w-full" v-model="model[index].body" />
                        </div>

                        <div class="block mt-4">
                            <InputLabel value="Тип ответа" />

                            <select class="rounded-md" v-model="model[index].answerType">
                                <option v-for="(typeTitle, typeValue) in answerTypeValues" :value="typeValue">
                                    {{ typeTitle }}
                                </option>
                            </select>
                        </div>

                        <div class="block mt-4">
                            <InputLabel value="Ответы" />

                            <div
                                v-if="model[index].answerType === 'pick_single' || model[index].answerType === 'pick_multiple'">
                                <div class="mb-4">
                                    <MutedText>
                                        Укажите полный список возможных ответов и отметьте правильные.
                                    </MutedText>
                                </div>
                                <div class="flex flex-row justify-start items-center" v-for="(answer, answerIndex) in model[index].answers" :key="answerIndex">
                                    <Checkbox class="flex-0" title="Пометить как правильный ответ"
                                        :checked="model[index].correctAnswers.includes(model[index].answers[answerIndex].id)"
                                        @update:checked="toggleCorrectAnswer(index, model[index].answers[answerIndex].id)" />
                                    <TextInput type="text" class="mt-1 mx-4 flex-1"
                                        v-model="model[index].answers[answerIndex].name" autocomplete="answer"
                                        placeholder="Ответ" />
                                    <div class="flex-0">
                                        <DangerButton title="Удалить" @click.prevent="removeAnswer(index, model[index].answers[answerIndex].id)">
                                            <TrashIcon />
                                        </DangerButton>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <SecondaryButton @click.prevent="addAnswer(index)">
                                        <AddIconBig /> Добавить
                                    </SecondaryButton>
                                </div>
                            </div>
                            <div
                                v-else-if="model[index].answerType === 'number_sequence' || model[index].answerType === 'custom_text'">
                                <div class="mb-4">
                                    <MutedText>
                                        Укажите полный список <b>правильных</b> ответов.
                                    </MutedText>
                                </div>

                                <div class="flex flex-row justify-start items-center" v-for="(answer, answerIndex) in model[index].correctAnswers" :key="answerIndex">
                                    <TextInput type="text" class="mt-1 mx-4 flex-1"
                                        v-model="model[index].correctAnswers[answerIndex]" autocomplete="answer"
                                        placeholder="Ответ" />
                                    <div class="flex-0">
                                        <DangerButton title="Удалить" @click.prevent="removeCorrectAnswer(index, answerIndex)">
                                            <TrashIcon />
                                        </DangerButton>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <SecondaryButton @click.prevent="addCorrectAnswer(index)">
                                        <AddIconBig /> Добавить
                                    </SecondaryButton>
                                </div>
                            </div>
                        </div>

                        <div class="block mt-4">
                            <InputLabel for="question_max_points" value="Максимальное количество баллов за вопрос" />

                            <input id="question_max_points" type="number" min="1" step="1"
                                v-model="model[index].maxPoints">
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox v-model:checked="model[index].allowPartiallyCorrectAnswers" />
                                <span class="ms-2">Начислять часть баллов при частично правильном ответе</span>
                            </label>
                        </div>

                        <div class="block mt-4" v-if="model[index].answerType === 'number_sequence'">
                            <label class="flex items-center">
                                <Checkbox v-model:checked="model[index].requireAscendingOrder" />
                                <span class="ms-2">Требовать указание чисел в порядке возрастания</span>
                            </label>
                        </div>
                    </template>
                </template>

            </div>
        </div>
    </div>
</template>

<style scoped>
.btnSelected {
    background-color: #adadad;
}
</style>