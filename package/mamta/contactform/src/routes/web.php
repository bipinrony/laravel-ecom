<?php

use Illuminate\Support\Facades\Route;
use Mamta\Contactform\Controllers\ContactMessageController;

Route::group(['middleware' => ['web', 'locale']], function () {
    Route::get('contact-form', [ContactMessageController::class, 'index'])->name('contact-form.index');
    Route::post('save-contact-form', [ContactMessageController::class, 'saveMessage'])->name('contact-form.saveMessage');
});
