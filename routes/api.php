<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Api\{VehicleController,
    CoachTourController,
    DriverController,
    PageController,
    RndImageController,
    TourController,
    UserController,
    VipServiceController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

// Tours routes
Route::group(['as' => 'tours.'], function () {
    Route::get('tours', [TourController::class, 'index'])->name('index');
    Route::get('tours/{tour}', [TourController::class, 'show'])->name('show');
    Route::get('tours/{tour}/days/{day}', [TourController::class, 'getDay'])->name('get-tour-details-in-day');
    Route::post('tours/{tour}/book', [TourController::class, 'book'])->middleware(['auth:sanctum'])->name('book');
});

// VIP services routes
Route::group(['as' => 'vip-services.'], function () {
    Route::get('/vip-services', [VipServiceController::class, 'index'])->name('index');
    Route::get('/vip-services/{vipService}', [VipServiceController::class, 'show'])->name('show');
//    Route::get('/vip-services/{vipService}/days/{day}', [VipServiceController::class, 'getDay'])->name(''); //TODO
    Route::post('/vip-services/{vipService}/book', [VipServiceController::class, 'book'])->middleware(['auth:sanctum'])->name('book');
});


// Coach tours routes
Route::group(['as' => 'coach-tours.'], function () {
    Route::get('/coach-tours', [CoachTourController::class, 'index'])->name('index');
    Route::get('/coach-tours/{coachTour}', [CoachTourController::class, 'show'])->name('show');
//    Route::get('/coach-tours/{coachTour}/days/{day}', [CoachTourController::class, 'getCoachTourDay'])->name('get-tour-day'); TODO
    Route::post('/coach-tours/{coachTour}/book', [CoachTourController::class, 'book'])->middleware(['auth:sanctum'])->name('book');
});

// Vehicles and drivers routes
Route::get('/vehicles', [VehicleController::class, 'index'])->middleware(['auth:sanctum'])->name('vehicles');
Route::get('/drivers', [DriverController::class, 'index'])->middleware(['auth:sanctum'])->name('drivers');

// User routes
Route::group(['as' => 'user.', 'middleware' => 'auth:sanctum'], function () {
    Route::group(['as' => 'favorites.'], function () {
        Route::get('/user/favorites', [FavoriteController::class, 'favorites'])->name('index');
        Route::post('/user/favorites/add', [FavoriteController::class, 'addFavorite'])->name('add');
        Route::post('/user/favorites/remove', [FavoriteController::class, 'removeFavorite'])->name('remove');
    });

    Route::group(['as' => 'profile.'], function () {
        Route::get('/user/profile', [ProfileController::class, 'profile'])->name('show');
        Route::post('/user/profile/', [ProfileController::class, 'updateProfile'])->name('update');
    });

    Route::get('/user/bookings', [UserController::class, 'bookings'])->name('bookings');

    // Partners routes
    Route::post('/become-partner', [PartnerController::class, 'becomePartner'])->name('become-partner');
});

// Page contents routes
Route::group(['as' => 'content.'], function () {
    Route::get('/home', [PageController::class, 'home'])->name('home-page');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us-page');
    Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us-page');
});

// Customer Enquiries routes
Route::post('/send-contact-enquiry', [SupportController::class, 'sendContactEnquiry'])->name('send-contact-enquiry');

// TODO: remove
// Test random image fetching routes
Route::get('/random-image', [RndImageController::class, 'getRandomImage']);

/*
 * TODO:
 * you can isolate services like favorites in separate files, and make them reusable
 *
 * another TODO:
 * make sure to reapply separation of concerns the best possible
 *
 * TODO:
 * put indexes for the remaining tables
 */
