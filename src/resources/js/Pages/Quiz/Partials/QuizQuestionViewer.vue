<script setup lang="ts">
import { computed, ref } from 'vue';
import { QuizQuestionData } from '@/types';
import MutedText from '@/Components/MutedText.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import HtmlViewer from '@/Components/HtmlViewer.vue';
import { Answer, AnswerEntry, AnswerMultiple, ResultsStats, validateAnswers } from './validateAnswers';


const props = defineProps<{
    questions: QuizQuestionData[];
}>();

const answers = ref<AnswerEntry[]>([]);

const currentAnswer = ref<Answer>('');
const currentAnswerMultiple = ref<AnswerMultiple>([]);

const selectedQuestionIndex = ref<number | null>(0);

const showResults = computed(() => {
    return selectedQuestionIndex.value === null;
});

const results = computed(() => {
    if (!showResults.value) {
        return <ResultsStats>{
            points: 0,
            maxPoints: 0,
            correctAnswers: 0,
            percentage: 0,
            answersComparison: [],
        };
    }

    return validateAnswers(props.questions, answers.value);
});

function submitAnswer() {
    if (selectedQuestionIndex.value === null) {
        return;
    }

    if (props.questions[selectedQuestionIndex.value].answerType === 'pick_multiple') {
        answers.value.push({
            questionIndex: selectedQuestionIndex.value,
            answer: currentAnswerMultiple.value,
        });
    } else {
        answers.value.push({
            questionIndex: selectedQuestionIndex.value,
            answer: currentAnswer.value,
        });
    }

    currentAnswer.value = '';
    currentAnswerMultiple.value = [];

    nextQuestion();

}

function nextQuestion() {
    if (selectedQuestionIndex.value === props.questions.length - 1) {
        selectedQuestionIndex.value = null;
    } else if (selectedQuestionIndex.value !== null) {
        selectedQuestionIndex.value += 1;
    }
}

</script>

<template>
    <div class="w-full min-h-32 flex flex-row items-start">
        <template v-if="questions.length === 0">
            <MutedText>
                В этом тесте нет вопросов.
            </MutedText>
        </template>

        <template v-else>
            <div class="flex-0 p-4 border-r flex flex-col justify-start items-stretch border-gray-400">
                <div v-for="(question, index) in questions" class="px-2 py-1 flex flex-row justify-between items-center"
                    :class="{ btnSelected: index === selectedQuestionIndex }">
                    <div class="mr-4">
                        Вопрос №{{ index + 1 }}
                    </div>
                </div>
            </div>
            <div class="flex-1 p-4">
                <template v-for="(question, index) in questions" :key="index">
                    <template v-if="index === selectedQuestionIndex">
                        <div class="text-2xl">
                            Вопрос №{{ index + 1 }}
                        </div>

                        <HtmlViewer :content="questions[index].body" />

                        <template v-if="questions[index].answerType === 'pick_single'">
                            <MutedText>
                                Выберите один вариант ответа.
                            </MutedText>

                            <div>
                                <div class="my-3" v-for="(answer, answerIndex) in questions[index].answers"
                                    :key="answerIndex">
                                    <input type="radio" :id="questions[index].answers[answerIndex].id"
                                        :value="questions[index].answers[answerIndex].id" v-model="currentAnswer" />
                                    <label class="ml-2" :for="questions[index].answers[answerIndex].id">
                                        {{ questions[index].answers[answerIndex].name }}
                                    </label>

                                </div>
                            </div>
                        </template>

                        <template v-else-if="questions[index].answerType === 'pick_multiple'">
                            <MutedText>
                                Выберите все правильные варианты ответа.
                            </MutedText>

                            <div>
                                <div class="my-3" v-for="(answer, answerIndex) in questions[index].answers"
                                    :key="answerIndex">
                                    <input type="checkbox" :id="questions[index].answers[answerIndex].id"
                                        :value="questions[index].answers[answerIndex].id"
                                        v-model="currentAnswerMultiple" />
                                    <label class="ml-2" :for="questions[index].answers[answerIndex].id">
                                        {{ questions[index].answers[answerIndex].name }}
                                    </label>

                                </div>
                            </div>
                        </template>

                        <template v-else-if="questions[index].answerType === 'number_sequence'">
                            <MutedText>
                                Введите последовательность цифр в поле ниже, без пробелов и дополнительных знаков.
                            </MutedText>

                            <div v-if="questions[index].requireAscendingOrder">
                                <MutedText>
                                    Цифры должны идти <b>в порядке возрастания</b>.
                                </MutedText>
                            </div>

                            <div>
                                <TextInput id="answer" type="text" class="mt-1 block w-full" v-model="currentAnswer"
                                    required autocomplete="answer" placeholder="Ответ" />
                            </div>
                        </template>

                        <template v-else-if="questions[index].answerType === 'custom_text'">
                            <MutedText>
                                Введите ответ в поле ниже.
                            </MutedText>

                            <div>
                                <TextInput id="answer" type="text" class="mt-1 block w-full" v-model="currentAnswer"
                                    required autocomplete="answer" placeholder="Ответ" />
                            </div>
                        </template>

                        <div class="mt-4">
                            <PrimaryButton class="block w-full" @click.prevent="submitAnswer">
                                Далее
                            </PrimaryButton>
                        </div>

                    </template>
                </template>

                <template v-if="showResults">
                    <div>
                        <div class="text-2xl">
                            Результаты
                        </div>

                        <div class="mt-4 text-5xl">
                            {{ results.percentage }}%
                        </div>

                        <div class="mt-4">
                            Баллы: {{ results.points }} / {{ results.maxPoints }}
                        </div>

                        <div class="mt-4">
                            Правильных ответов: {{ results.correctAnswers }} / {{ questions.length }}
                        </div>

                        <hr>

                        <div>
                            <div class="text-2xl mt-4">
                                Сравнение ответов
                            </div>

                            <div v-for="(question, index) in questions" :key="index">
                                <div class="text-xl mt-4">
                                    Вопрос №{{ index + 1 }}
                                </div>

                                <div class="my-2">
                                    <HtmlViewer :content="question.body" />
                                </div>

                                <div>
                                    <b>Ваш ответ:</b> {{ results.answersComparison[index].yourAnswer !== '' ?
                                        results.answersComparison[index].yourAnswer : '[Пусто]' }}
                                </div>
                                <div>
                                    <b>Правильный ответ:</b> {{ results.answersComparison[index].correctAnswer }}
                                </div>
                                <div>
                                    <b>Баллы:</b> {{ results.answersComparison[index].points }} / {{ question.maxPoints
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>

<style scoped>
.btnSelected {
    background-color: #adadad;
}
</style>