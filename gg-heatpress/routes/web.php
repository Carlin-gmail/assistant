<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeftoverController;
use App\Http\Controllers\TransferTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Livewire\Actions\Logout;

// Route::get('/profile', [ProfileController::class, 'edit'])
//     ->name('profile');

Route::get('/logout', Logout::class)->name('logout');

// CSV generation routes
Route::Post('/csv', [CustomerController::class, 'saveBatchCsv'])->name('csv.save');

Route::get('/customers/batch-create', function () {
    return view('customers.batch-create');
})->name('customers.batch-create');

Route::get('/get-missing-bags',[CustomerController::class, 'getMissingBags'])->name('customers.get-missing-bags');

Route::post('/customers/store-batch', [CustomerController::class, 'storeBatch'])
    ->name('customers.store-batch');

Route::get('/js', fn()=>
    view('delete-me.learningJS'));


Route::get('/', [DashboardController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Laravel's Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Customers (full resource + search)
    |--------------------------------------------------------------------------
    */

    Route::resource('customers', CustomerController::class);

    // /customers/search (extra)
    Route::get('/customers-search', [CustomerController::class, 'search'])
        ->name('customers.search');

    /*
    |--------------------------------------------------------------------------
    | Bags (full resource + searchById)
    |--------------------------------------------------------------------------
    */

    Route::resource('bags', BagController::class);

    // search by raw bag ID
    Route::get('/bags/id/{id}', [BagController::class, 'searchById'])
        ->name('bags.searchById');


    /*
    |--------------------------------------------------------------------------
    | Leftovers (nested under bags)
    |--------------------------------------------------------------------------
    |
    | We DO NOT use Route::resource here because leftovers do not follow a
    | standard CRUD model — they belong to bags, and operations are custom.
    |
    */

    Route::prefix('bags/{bag}/leftovers')->name('leftovers.')->group(function () {

        // Show create form
        Route::get('/create', [LeftoverController::class, 'create'])
            ->name('create');

        // Store new batch
        Route::post('/', [LeftoverController::class, 'store'])
            ->name('store');

        // FIFO consume
        Route::post('/consume', [LeftoverController::class, 'consume'])
            ->name('consume');

    });

    // Feedbacks management

    Route::prefix('feedbacks')->name('feedbacks.')->group(function () {

        // List feedbacks
        Route::get('/', [FeedbackController::class, 'index'])
            ->name('index');
    });


    // Global leftovers inventory

    Route::get('/leftovers/{leftover}/edit', [LeftoverController::class, 'edit'])
        ->name('leftovers.edit');

    Route::get('/leftovers', [LeftoverController::class, 'index'])
        ->name('leftovers.index');

    // Global leftovers search
    Route::get('/leftovers/search', [LeftoverController::class, 'search'])
        ->name('leftovers.search');

    Route::put('/leftovers/{leftover}', [LeftoverController::class, 'update'])
              ->name('leftovers.update');

    // Expired update
    Route::post('/leftovers/update-expired', [LeftoverController::class, 'updateExpired'])
        ->name('leftovers.update-expired');

    // GLOBAL Leftover creation
    Route::post('/leftovers/store-global', [LeftoverController::class, 'storeGlobal'])
        ->name('leftovers.store-global');

    Route::get('/leftovers/create-global', [LeftoverController::class, 'createGlobal'])
    ->name('leftovers.create-global');

    // SETTINGS
    Route::get('/settings', function () {
        return view('settings.index');
    })->middleware('auth')->name('settings.index');

    /*
    |--------------------------------------------------------------------------
    | Transfer Types (partial resource)
    |--------------------------------------------------------------------------
    |
    | Only index, store, update are needed.
    | pressingSettingsModal stays as a custom route.
    |
    */

    Route::resource('transfer-types', TransferTypeController::class);

    // Modal JSON route
    Route::get('/transfer-types/{type}/modal',
        [TransferTypeController::class, 'pressingSettingsModal']
    )->name('transfer-types.modal');


    /*
    |--------------------------------------------------------------------------
    | Profile (Breeze)
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Users
    |-------------------------------------------------------------------------
    */
    Route::resource('/user', UserController::class);
});


require __DIR__.'/auth.php';
