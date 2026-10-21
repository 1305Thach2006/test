<?php
// SPDX-License-Identifier: Apache-2.0
// Định nghĩa các lệnh console bổ sung

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:acc', function () {
    $this->info('AI Career Coach - Open Source Edition (Laravel + Blade + Tailwind CSS + Ollama)');
})->purpose('Hiển thị thông tin phiên bản AI Career Coach');
