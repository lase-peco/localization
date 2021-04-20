<?php

use Illuminate\Support\Facades\Route;
use LasePeco\Localization\Http\Controllers\SetLocaleController;

Route::get('locale/{locale}', SetLocaleController::class)->name('locale')->middleware(['web']);
