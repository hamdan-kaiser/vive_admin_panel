<?php

use Hashibul\CrudGenerator\Http\Controllers\GeneratorController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('generator', [GeneratorController::class, 'index'])->name('generator');
    Route::get('column-details-template/{columns}', [GeneratorController::class, 'loadTempalte'])->name('column.details.template');
    Route::post('generator/crud', [GeneratorController::class, 'generateCrud'])->name('generator.crud.post');
    Route::post('generator/asser', [GeneratorController::class, 'generateAsset'])->name('generator.asset.post');
    Route::get('generator-foreign-key-details/{model}', [GeneratorController::class, 'foreignKeyDetails'])->name('generator.foreign.key.details');
});
