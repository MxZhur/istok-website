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

export type TeachingMaterialType = 'methodological_work' | 'educational_work';

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

export type EntityType = 'blog_post' | 'learning_material' | 'teaching_material';

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
}

export type TagData = {
    id: number;
    name: string;
}

export type StorageFileData = {
    id: number;
    path: string;
    url: string;
    original_name: string;
    type: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
