<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingController;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
  
Route::prefix('bookings')->group(function () {
    Route::get('slots-available', [BookingController::class, 'slotsAvailable']);
    Route::post('{classRoom}/book', [BookingController::class, 'store']);
    Route::delete('{booking}/delete', [BookingController::class, 'destroy']);
});


