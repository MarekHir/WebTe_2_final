<?php


use Illuminate\Support\Facades\Route;

Route::get('/{nieco?}', function () {
    return response()->file(public_path('index.html'));
})->where('nieco', '^(?!.*api\/|.*sanctum\/csrf-cookie).*$');
