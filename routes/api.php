<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\JobOfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('user', [AuthController::class,'user']);
    Route::post('register', [AuthController::class,'register']);

});

Route::group([

    'middleware' => 'api',

], function () {

    Route::resource('document', DocumentController::class,['except'=>['create','edit']])->names('document');

});

Route::group([

    'middleware' => 'api',

], function () {

    Route::resource('job_offer', JobOfferController::class,['except'=>['create','edit']])->names('job_offer');
    
    Route::get('user/job_offer', [JobOfferController::class, 'job_offers_users']);
    
    Route::get('user/job_offer/create', [JobOfferController::class, 'create_apply_to_job_offer']);
    
    Route::post('user/job_offer/apply', [JobOfferController::class, 'apply_to_job_offer']);

});
