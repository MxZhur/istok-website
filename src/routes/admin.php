<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\LearningMaterialController;
use App\Http\Controllers\Admin\TeachingMaterialController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');

    Route::resource('blog_posts', BlogPostController::class)->names('admin.blog_posts');
    Route::resource('learning_materials', LearningMaterialController::class)->names('admin.learning_materials');
    Route::resource('teaching_materials', TeachingMaterialController::class)->names('admin.teaching_materials');

    Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::put('comments/{id}/block', [CommentController::class, 'block'])->name('admin.comments.block');
});
