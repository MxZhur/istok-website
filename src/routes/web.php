<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChangeLogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExpertClubController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningMaterialController;
use App\Http\Controllers\TeachingMaterialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{id}', [BlogController::class, 'show'])->name('blog.show');
});

Route::prefix('learning_material')->group(function () {
    Route::get('/', [LearningMaterialController::class, 'index'])->name('learning_material.index');
    Route::get('/{grade}', [LearningMaterialController::class, 'grade'])->name('learning_material.grade');
    Route::get('/{grade}/{id}', [LearningMaterialController::class, 'show'])->name('learning_material.show');
});

Route::prefix('teaching_material')->middleware('teacher')->group(function () {
    Route::get('/', [TeachingMaterialController::class, 'index'])->name('teaching_material.index');
    Route::get('/{type}', [TeachingMaterialController::class, 'type'])->name('teaching_material.type');
    Route::get('/{type}/{id}', [TeachingMaterialController::class, 'show'])->name('teaching_material.show');
});

Route::prefix('expert_club')->group(function () {
    Route::get('/', [ExpertClubController::class, 'index'])->name('expert_club.index');
    Route::get('/{id}', [ExpertClubController::class, 'show'])->name('expert_club.show');
});

Route::prefix('change_log')->group(function () {
    Route::get('/', [ChangeLogController::class, 'index'])->name('change_log.index');
    Route::get('/{year}', [ChangeLogController::class, 'year'])->name('change_log.year');
});

Route::get('/download/{id}', [DownloadController::class, 'download'])->name('file.download');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/new-comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
