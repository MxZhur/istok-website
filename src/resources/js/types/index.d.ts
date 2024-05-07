export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    role: number;
    is_admin: boolean;
}

export type BlogPostItemData = {
    id: number;
    title: string;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
};

export type BlogPostData = {
    id: number;
    title: string;
    body: string;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
    storage_files: StorageFileData[];
};

export type LearningMaterialItemData = {
    id: number;
    title: string;
    grade: number;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
};

export type LearningMaterialData = {
    id: number;
    title: string;
    body: string;
    grade: number;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
    storage_files: StorageFileData[];
};

export type TeachingMaterialType = "methodological_work" | "educational_work";

export type TeachingMaterialItemData = {
    id: number;
    title: string;
    type: TeachingMaterialType;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
};

export type TeachingMaterialData = {
    id: number;
    title: string;
    body: string;
    type: TeachingMaterialType;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
    storage_files: StorageFileData[];
};

export type ExpertClubItemData = {
    id: number;
    title: string;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
};

export type ExpertClubEntryData = {
    id: number;
    title: string;
    body: string;
    created_at: string | null;
    updated_at: string | null;
    tags: TagData[];
    storage_files: StorageFileData[];
};

export type MiniGameCategory =
    | "world_history"
    | "russia_9_13_century"
    | "russia_14_17_century"
    | "russia_18_19_century"
    | "russia_20_century"
    | "russia_21_century";

export type MiniGameItemData = {
    id: number;
    category: string;
    title: string;
    created_at: string | null;
    updated_at: string | null;
};

export type MiniGameData = {
    id: number;
    category: string;
    title: string;
    body: string;
    created_at: string | null;
    updated_at: string | null;
};

export type QuizType = "grade_9" | "grade_11";

export type QuizAnswerType = "pick_single" | "pick_multiple" | "number_sequence" | "custom_text";

export type QuizQuestionData = {
    id: string;
    body: string;
    answerType: QuizAnswerType;
    answers: {
        id: string;
        name: string;
    }[];
    correctAnswers: string[];
    maxPoints: number;
    allowPartiallyCorrectAnswers: boolean;
    requireAscendingOrder: boolean;
};

export type QuizItemData = {
    id: number;
    title: string;
    type: QuizType;
    created_at: string | null;
    updated_at: string | null;
};

export type QuizData = {
    id: number;
    title: string;
    type: QuizType;
    questions: QuizQuestionData[];
    created_at: string | null;
    updated_at: string | null;
}

export type EntityType =
    | "blog_post"
    | "learning_material"
    | "teaching_material"
    | "expert_club";

export type CommentData = {
    id: number;
    entity_type: EntityType;
    entity_id: number;
    parent_id: number;
    user_id: number;
    text: string;
    is_blocked: boolean;
    created_at: string | null;
    updated_at: string | null;
    user: User;
    children?: CommentData[];
};

export type FeedbackEntryData = {
    id: number;
    user_id: number;
    text: string;
    created_at: string | null;
    updated_at: string | null;
    user: User;
};

export type TagData = {
    id: number;
    name: string;
};

export type StorageFileData = {
    id: number;
    path: string;
    url: string;
    original_name: string;
    type: string;
};

export type CustomPageData = {
    id: number;
    key: string;
    title: string;
    body: string;
    created_at: string | null;
    updated_at: string | null;
};

export type ChangeLogEntryData = {
    id: number;
    year: number;
    section: string;
    action_type: string;
    link_name: string;
    link_url: string;
    created_at: string | null;
    updated_at: string | null;
};

export type BreadcrumbData = {
    title: string;
    url?: string;
};

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};
