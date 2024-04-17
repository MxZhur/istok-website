export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    role: number;
    is_admin: boolean;
}

export type BlogPostData = {
    id: number;
    title: string;
    body: string;
    tags: TagData[];
    storage_files: StorageFileData[];
};

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
