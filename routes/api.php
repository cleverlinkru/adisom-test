<?php

use Illuminate\Support\Facades\Route;

Route::prefix('recommendations')->name('recommendations.')->group(function () {
    Route::get('', \Apps\AdisomTest\Http\Controllers\Recommendations\IndexController::class)->name('index');
});
