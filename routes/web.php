<?php
// SPDX-License-Identifier: Apache-2.0
// Định tuyến giao diện Web HTML (Blade + Tailwind CSS) theo mục 4.7 PLAN.md

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

// 7 Route giao diện chính theo mục 4.7 PLAN.md
Route::get('/', [WebController::class, 'landing'])->name('landing');
Route::get('/onboarding', [WebController::class, 'onboarding'])->name('onboarding');
Route::get('/profiles/{id}', [WebController::class, 'showProfile'])->name('profiles.show');
Route::get('/reports/{id}', [WebController::class, 'showReport'])->name('reports.show');
Route::get('/reports/{id}/roadmap', [WebController::class, 'showRoadmap'])->name('reports.roadmap');
Route::get('/interview/{sessionId}', [WebController::class, 'showInterview'])->name('interview.show');
Route::get('/settings', [WebController::class, 'settings'])->name('settings');
Route::post('/settings', [WebController::class, 'updateSettings'])->name('settings.update');
Route::delete('/settings/purge', [WebController::class, 'purgeAllData'])->name('settings.purge');

// Tài liệu OpenAPI / Swagger UI tại /api/docs (mục 4.6 PLAN.md)
Route::get('/api/docs', [WebController::class, 'apiDocs'])->name('api.docs');
Route::get('/api/openapi.json', [WebController::class, 'openApiSpec'])->name('api.openapi');
