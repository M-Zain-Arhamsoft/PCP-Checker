<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PrimaryLeadsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// routes/web.php

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/register', function () {
    return redirect('/login');
});

Route::middleware('notLoggedIn')->get('/', function () {
    return redirect('/login');
});

Route::get('/create', [HomeController::class, 'create'])->name('createssbleads');

Route::post('/storessb', [HomeController::class, 'storessb'])->name('storessbleads');

Route::get('/createprimary', [PrimaryLeadsController::class, 'create'])->name('createpleads');

Route::post('/storepleads', [PrimaryLeadsController::class, 'store'])->name('storepleads');

// Route::get('/completed', [App\Http\Controllers\HomeController::class, 'completed'])->name('completed');

// Route::post('/filter', [App\Http\Controllers\HomeController::class, 'completed'])->name('completed');

// Route::get('export', 'MyController@export')->name('export');
// Route::get('importExportView', 'MyController@importExportView');
// Route::post('import', 'MyController@import')->name('import');


// Define your routes
Route::get('export', [HomeController::class, 'export'])->name('export');
Route::get('importExportView', [HomeController::class, 'importExportView']);
Route::post('import', [HomeController::class, 'import'])->name('import');
