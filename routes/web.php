<?php

use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebPagesController;
use App\Livewire\Admin\AboutUs;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\ContactUs;
use App\Livewire\Admin\Features;
use App\Livewire\Admin\Gallery;
use App\Livewire\Admin\Index;
use App\Livewire\Admin\Location;
use App\Livewire\Admin\OurServices;
use App\Livewire\Admin\Partner;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Sliders;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#New Version
Route::middleware(['web'])->group(function () {

    Route::get('index', [Controller::class, 'index'])->name('index');

    Route::prefix('admin/')->as('admin.')->group(function () {

        Route::middleware(['guest'])->group(function () {
            Route::get('login', Login::class)->name('login');
        });

        Route::middleware(['auth'])->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('sliders', Sliders::class)->name('sliders');
            Route::get('features', Features::class)->name('features');
            Route::get('about-us', AboutUs::class)->name('about-us');
            Route::get('our-services', OurServices::class)->name('our-services');
            Route::get('locations', Location::class)->name('locations');
            Route::get('gallery', Gallery::class)->name('gallery');
            Route::get('partners', Partner::class)->name('partners');
            Route::get('settings', Settings::class)->name('settings');
            Route::get('contact-us', ContactUs::class)->name('contact-us');
        });

        Route::controller(AdminPagesController::class)->group(function () {
            Route::get('logout', 'logout')->name('logout');
        });
    });



    Route::as('web.')->group(function () {
        Route::get('/', [WebPagesController::class, 'landingPage'])->name('landing-page');
    });
});


Route::get('test', function () {
    return view('welcome');
});
