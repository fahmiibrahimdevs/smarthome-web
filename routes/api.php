<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/count-data', [APIController::class, 'countData']);

// M Q T T
Route::get('/mqtt', [APIController::class, 'getMQTT']);
Route::patch('/mqtt/{uuid}', [APIController::class, 'updateMQTT']);

// R O O M S
Route::get('/rooms', [APIController::class, 'getRooms']);
Route::post('/rooms', [APIController::class, 'storeRooms']);
Route::get('/rooms/{uuid}/detail', [APIController::class, 'getDetailRooms']);
Route::patch('/rooms/{uuid}', [APIController::class, 'updateRooms']);
Route::delete('/rooms/{uuid}', [APIController::class, 'deleteRooms']);

// C A T E G O R I E S
Route::get('/categories', [APIController::class, 'getCategory']);
Route::post('/categories', [APIController::class, 'storeCategory']);
Route::get('/categories/{uuid}/detail', [APIController::class, 'getDetailCategory']);
Route::patch('/categories/{uuid}', [APIController::class, 'updateCategory']);
Route::delete('/categories/{uuid}', [APIController::class, 'deleteCategory']);

// F E A T U R E S
Route::get('/features', [APIController::class, 'getFeatures']);
Route::post('/features', [APIController::class, 'storeFeatures']);
Route::get('/features/{uuid}/detail', [APIController::class, 'getDetailFeatures']);
Route::patch('/features/{uuid}', [APIController::class, 'updateFeatures']);
Route::delete('/features/{uuid}', [APIController::class, 'deleteFeatures']);

// D E V I C E S
Route::get('/device/{uuidRoom}/{category}', [APIController::class, 'getDevices']);
Route::post('/devices', [APIController::class, 'storeDevices']);
Route::get('/devices/{uuid}/detail', [APIController::class, 'getDetailDevices']);
Route::patch('/devices/{id}', [APIController::class, 'updateDevices']);
Route::delete('/devices/{uuid}', [APIController::class, 'deleteDevices']);

// // P O W E R  M O N I T O R I N G
// Route::post('/power-monitor', [APIController::class, 'storePowerMonitor']);
// Route::get('/power-monitor/{uuidRoom}/{category}', [APIController::class, 'getPowerMonitor']);
// Route::get('/power-monitor/{uuidRoom}/{category}', [APIController::class, 'getPowerMonitor']);
// Route::get('/power-monitor/{uuidRoom}/{category}', [APIController::class, 'getPowerMonitor']);