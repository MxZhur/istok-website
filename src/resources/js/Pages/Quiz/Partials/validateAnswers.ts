import { QuizQuestionData } from "@/types";

export type Answer = string;
export type AnswerMultiple = string[];

export type AnswerEntry = {
    questionIndex: number;
    answer: Answer | AnswerMultiple;
};

export type AnswerComparison = {
    questionIndex: number;
    isCorrect: boolean;
    yourAnswer: string;
    correctAnswer: string;
    points: number;
};

export type ResultsStats = {
    points: number;
    maxPoints: number;
    correctAnswers: number;
    percentage: number;
    answersComparison: AnswerComparison[];
};

function validateAnswer(question: QuizQuestionData, answer: AnswerEntry) {
    let yourAnswer: string;
    let correctAnswer;

    if (
        question.answerType === "pick_single" ||
        question.answerType === "pick_multiple"
    ) {
        if (Array.isArray(answer.answer)) {
            const yourAnswerNames = answer.answer
                .map((answerId) => {
                    const answer = question.answers.find(
                        (a) => a.id === answerId
                    );

                    if (answer === undefined) {
                        return "";
                    }

                    return answer.name;
                })
                .filter((a) => a !== "");

            yourAnswer = yourAnswerNames.join(", ");
        } else {
            const answerObj = question.answers.find(
                (a) => a.id === answer.answer
            );

            if (answerObj === undefined) {
                yourAnswer = "";
            } else {
                yourAnswer = answerObj.name;
            }
        }

        const correctAnswerNames = question.correctAnswers
            .map((answerId) => {
                const answer = question.answers.find((a) => a.id === answerId);

                if (answer === undefined) {
                    return "";
                }

                return answer.name;
            })
            .filter((a) => a !== "");

        correctAnswer = correctAnswerNames.join(", ");
    } else {
        if (Array.isArray(answer.answer)) {
            yourAnswer = answer.answer.join(", ");
        } else {
            yourAnswer = answer.answer;
        }
        correctAnswer = question.correctAnswers.join(", ");
    }

    let points: number;
    let isCorrect: boolean;

    if (question.answerType === "pick_single") {
        const correctAnswerNames = question.correctAnswers
            .map((answerId) => {
                const answer = question.answers.find((a) => a.id === answerId);

                if (answer === undefined) {
                    return "";
                }

                return answer.name;
            })
            .filter((a) => a !== "");

        isCorrect = correctAnswerNames.includes(yourAnswer);

        points = isCorrect ? question.maxPoints : 0;
    } else if (question.answerType === "pick_multiple") {
        if (Array.isArray(answer.answer)) {
            const correctAnswersCount = answer.answer.filter((a) =>
                question.correctAnswers.includes(a)
            ).length;

            if (
                answer.answer.length > 0 &&
                question.correctAnswers.length > 0
            ) {
                points = Math.floor(
                    question.maxPoints *
                        (correctAnswersCount /
                            Math.max(
                                answer.answer.length,
                                question.correctAnswers.length
                            ))
                );
                isCorrect = points === question.maxPoints;
            } else {
                points = 0;
                isCorrect = false;
            }
        } else {
            isCorrect = question.correctAnswers.includes(yourAnswer);
            points = isCorrect ? question.maxPoints : 0;
        }
    } else if (question.answerType === "number_sequence") {
        if (question.requireAscendingOrder) {
            isCorrect = question.correctAnswers.includes(yourAnswer);
            points = isCorrect ? question.maxPoints : 0;
        } else {
            let answerSplit: string[];

            if (Array.isArray(answer.answer)) {
                answerSplit = answer.answer;
            } else {
                answerSplit = answer.answer.split("");
            }

            if (question.correctAnswers.length > 0) {
                const correctAnswer = question.correctAnswers[0];
                const correctAnswerSplit = correctAnswer.split("");

                const correctNumbersCount = answerSplit.filter((n) =>
                    correctAnswerSplit.includes(n)
                ).length;

                if (answerSplit.length > 0 && correctAnswerSplit.length > 0) {
                    points = Math.floor(
                        question.maxPoints *
                            (correctNumbersCount /
                                Math.max(
                                    answerSplit.length,
                                    correctAnswerSplit.length
                                ))
                    );
                } else {
                    points = 0;
                    isCorrect = false;
                }
            } else {
                points = 0;
            }

            isCorrect = points === question.maxPoints;
        }
    } else if (question.answerType === "custom_text") {
        isCorrect = question.correctAnswers
            .map((a) => a.toLowerCase())
            .includes(yourAnswer.toLowerCase());

        points = isCorrect ? question.maxPoints : 0;
    } else {
        isCorrect = false;
        points = 0;
    }

    points = Math.floor(points);

    return <AnswerComparison>{
        questionIndex: answer.questionIndex,
        yourAnswer,
        correctAnswer,
        isCorrect,
        points,
    };
}

export function validateAnswers(
    questions: QuizQuestionData[],
    answers: AnswerEntry[]
) {
    let points: number = 0;
    let maxPoints: number = 0;
    let correctAnswers: number = 0;
    let percentage: number = 0;
    let answersComparison: AnswerComparison[] = [];

    for (let i = 0; i < questions.length; i++) {
        const question = questions[i];

        maxPoints += question.maxPoints;

        const answer = answers.find((a) => a.questionIndex === i);

        if (answer === undefined) {
            answersComparison.push({
                questionIndex: i,
                yourAnswer: "",
                correctAnswer: "",
                isCorrect: false,
                points: 0,
            });

            continue;
        }

        const comparison = validateAnswer(question, answer);
        answersComparison.push(comparison);

        points += comparison.points;

        if (comparison.isCorrect) {
            correctAnswers += 1;
        }
    }

    percentage = Math.floor((points / maxPoints) * 100);

    return <ResultsStats>{
        points,
        maxPoints,
        correctAnswers,
        percentage,
        answersComparison,
    };
}
