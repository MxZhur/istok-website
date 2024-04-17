<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\StorageFile;
use Illuminate\Support\Facades\Storage;

class StorageFileService
{
    public const STORAGE_ROOT = 'public/';

    public function saveFiles(array $uploadedFiles, string $subfolder)
    {
        $result = [];

        foreach ($uploadedFiles as $uploadedFile) {
            $result[] = $this->saveFile($uploadedFile, $subfolder);
        }

        return $result;
    }


    public function saveFile(UploadedFile $uploadedFile, string $subfolder): StorageFile
    {
        // Store the file

        $newPath = $uploadedFile->storePublicly(static::STORAGE_ROOT . $subfolder);

        // Create the model and return it

        return StorageFile::create([
            'path' => $newPath,
            'url' => Storage::url($newPath),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'type' => $uploadedFile->getClientMimeType(),
        ]);
    }


    public function deleteFileByUrl(string $fileUrl)
    {
        // Delete the model

        $storageFileModel = StorageFile::query()->where('url', $fileUrl)->first();

        if ($storageFileModel !== null) {
            $storageFileModel->delete();
        }
    }
}
