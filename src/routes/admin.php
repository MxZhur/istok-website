<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\LearningMaterialController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');

    Route::resource('blog_posts', BlogPostController::class)->names('admin.blog_posts');
    Route::resource('learning_materials', LearningMaterialController::class)->names('admin.learning_materials');
});
