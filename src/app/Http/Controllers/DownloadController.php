<?php

namespace App\Http\Controllers;

use App\Models\StorageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(int $id) {
        $storageFile = StorageFile::findOrFail($id);

        return Storage::download($storageFile->path, $storageFile->original_name);
    }
}
