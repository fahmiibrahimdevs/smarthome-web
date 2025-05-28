<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Kategori\Kategori;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Livewire\Configure\Category;
use App\Http\Livewire\Configure\Feature;
use App\Http\Livewire\Configure\Location;
use App\Http\Livewire\Configure\Mqtt;
use App\Http\Livewire\Configure\Room;
use App\Http\Livewire\Dashboard\DashboardDevice;
use App\Http\Livewire\Device\Monitoring;
use App\Http\Livewire\Device\Power;
use App\Http\Livewire\Device\Remote;
use App\Http\Livewire\Device\SensorTh;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('/', [AuthenticatedSessionController::class, 'store']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('dashboard-devices/{uuidRoom}', DashboardDevice::class)->name('dashboard-devices');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('mqtt', Mqtt::class)->name('mqtt');
    Route::get('location', Location::class)->name('location');
    Route::get('room', Room::class)->name('room');
    Route::get('category', Category::class)->name('category');
    Route::get('feature', Feature::class)->name('feature');

    Route::get('device-power', Power::class)->name('device-power');
    Route::get('device-remote', Remote::class)->name('device-remote');
    Route::get('device-th', SensorTh::class)->name('device-th');
    Route::get('device-monitoring', Monitoring::class)->name('device-monitoring');
});

Route::group(['middleware' => ['auth', 'role:user']], function() {
});

Route::group(['middleware' => ['auth', 'role:developer']], function() {
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
