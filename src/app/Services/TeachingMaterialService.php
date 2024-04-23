<?php

namespace App\Services;

use App\Models\TeachingMaterial;
use App\Models\StorageFile;

class TeachingMaterialService
{
    public function store(array $data) {
        if (empty($data['body'])) {
            $data['body'] = '';
        }

        if (empty($data['tags'])) {
            $data['tags'] = [];
        }

        if (empty($data['newFiles'])) {
            $data['newFiles'] = [];
        }

        $tagService = new TagService();
        $storageFileService = new StorageFileService();

        $tagsIds = $tagService->populateTags($data['tags']);

        $newFileModels = $storageFileService->saveFiles($data['newFiles'], 'blog_post_images');

        $newFileIds = array_map(function (StorageFile $file) {
            return $file->id;
        }, $newFileModels);

        unset($data['tags']);
        unset($data['newFiles']);

        $newItem = TeachingMaterial::create($data);

        $newItem->tags()->attach($tagsIds);

        $newItem->storage_files()->attach($newFileIds);
    }

    public function update(TeachingMaterial $item, array $data) {
        if (empty($data['body'])) {
            $data['body'] = '';
        }

        if (empty($data['tags'])) {
            $data['tags'] = [];
        }

        if (empty($data['newFiles'])) {
            $data['newFiles'] = [];
        }

        if (empty($data['filesToDelete'])) {
            $data['filesToDelete'] = [];
        }

        $tagService = new TagService();
        $storageFileService = new StorageFileService();

        $tagsIds = $tagService->populateTags($data['tags']);

        $newFileModels = $storageFileService->saveFiles($data['newFiles'], 'blog_post_images');

        $newFileIds = array_map(function (StorageFile $file) {
            return $file->id;
        }, $newFileModels);

        foreach ($data['filesToDelete'] as $fileToDelete) {
            $storageFileService->deleteFileByUrl($fileToDelete);
        }

        unset($data['tags']);
        unset($data['newFiles']);
        unset($data['filesToDelete']);

        $item->fill($data);
        $item->save();

        $item->tags()->sync($tagsIds);

        $item->storage_files()->attach($newFileIds);
    }
}
