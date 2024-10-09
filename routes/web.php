<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\RewardSettingController;
use App\Http\Controllers\WaTemplateController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('home');
    Route::get('about', [WebsiteController::class, 'about'])->name('about');
    Route::get('contact', [WebsiteController::class, 'contact'])->name('contact');
    Route::post('contact', [WebsiteController::class, 'contact_store'])->name('contact.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('customer', CustomerController::class);
    Route::get('/customer-export', [CustomerController::class, 'export'])->name('customer.export');
    Route::get('/customer/{customer}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::resource('/purchase', PurchaseController::class);
    Route::get('/purchase/{purchase}/delete', [PurchaseController::class, 'delete'])->name('purchase.delete');
    Route::resource('messenger', MessengerController::class)->only(methods: [
        'index',
        'create',
        'store',
    ]);
    Route::get('/redeem', [RedeemController::class, 'index'])->name('redeem.index');
    Route::get('/redeem/{customer}/create', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem/{customer}/create', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/{redeem}/show', [RedeemController::class, 'show'])->name('redeem.show');
    Route::get('/redeem/{redeem}/payment', [RedeemController::class, 'create_payment'])->name('redeem.payment');
    Route::put('/redeem/{redeem}/payment', [RedeemController::class, 'store_payment'])->name('redeem.payment.store');
    Route::get('/redeem/{redeem}/payment/edit', [RedeemController::class, 'edit_payment'])->name('redeem.payment.edit');
    Route::put('/redeem/{redeem}/payment/update', [RedeemController::class, 'update_payment'])->name('redeem.payment.update');
    // Route::resource('/redeem', RedeemController::class);
    // Route::get('/redeem/{redeem}/delete', [RedeemController::class, 'delete'])->name('redeem.delete');
    Route::get('/reward', [RewardSettingController::class, 'index'])->name('setting.reward.index');
    Route::get('/reward-export', [DashboardController::class, 'exportTopReworderCustomer'])->name('reward-export');
    Route::get('/reward/{rewardSetting}/edit', [RewardSettingController::class, 'edit'])->name('setting.reward.edit');
    Route::put('/reward/{rewardSetting}/edit', [RewardSettingController::class, 'update'])->name('setting.reward.update');

    Route::resource('wa-template', WaTemplateController::class)->except('show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password', [ProfileController::class, 'password_get'])->name('password.edit');
    Route::patch('/password', [ProfileController::class, 'password_post'])->name('password.update');

});

require __DIR__ . '/auth.php';