<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\
{
    CustomerController,
    BagController,
    DashboardController,
    LeftoverController,
    TransferTypeController,
    ProfileController,
    UserController,
    FeedbackController,
    SystemConversationController
};

use App\Livewire\Actions\Logout;

/*
|--------------------------------------------------------------------------
| Public / Utility Routes
|--------------------------------------------------------------------------
*/

// DELETE ME
Route::get('/test', fn () => view('test.index'));

Route::get('/js', fn () => view('delete-me.learningJS'));

Route::get('/logout', Logout::class)->name('logout');

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
       */


    Route::get('/customers-search', [CustomerController::class, 'search'])
        ->name('customers.search');

    Route::post('/customers/store-batch', [CustomerController::class, 'storeBatch'])
        ->name('customers.store-batch');

    Route::get('/customers/batch-create', function () {
        return view('customers.batch-create');
    }
    )->name('customers.batch-create');

    Route::post('/csv', [CustomerController::class, 'saveBatchCsv'])
    ->name('csv.save');

    Route::get('/get-missing-bags', [CustomerController::class, 'getMissingBags'])
        ->name('customers.get-missing-bags');

    Route::resource('customers', CustomerController::class);

    /*
    |--------------------------------------------------------------------------
    | Bags
    |--------------------------------------------------------------------------
    */


    Route::get('/bags/id/{id}', [BagController::class, 'searchById'])
        ->name('bags.searchById');

    Route::resource('bags', BagController::class);


    /*
    |--------------------------------------------------------------------------
    | Leftovers (Nested + Global)
    |--------------------------------------------------------------------------
    */

    Route::prefix('bags/{bag}/leftovers')->name('leftovers.')->group(function () {
        Route::get('/create', [LeftoverController::class, 'create'])->name('create');
        Route::post('/', [LeftoverController::class, 'store'])->name('store');
        Route::post('/consume', [LeftoverController::class, 'consume'])->name('consume');
    });

    Route::get('/leftovers', [LeftoverController::class, 'index'])->name('leftovers.index');
    Route::get('/leftovers/search', [LeftoverController::class, 'search'])->name('leftovers.search');
    Route::get('/leftovers/{leftover}/edit', [LeftoverController::class, 'edit'])->name('leftovers.edit');
    Route::put('/leftovers/{leftover}', [LeftoverController::class, 'update'])->name('leftovers.update');

    Route::post('/leftovers/update-expired', [LeftoverController::class, 'updateExpired'])
        ->name('leftovers.update-expired');

    Route::post('/leftovers/store-global', [LeftoverController::class, 'storeGlobal'])
        ->name('leftovers.store-global');

    Route::get('/leftovers/create-global', [LeftoverController::class, 'createGlobal'])
        ->name('leftovers.create-global');

    /*
    |--------------------------------------------------------------------------
    | Feedbacks
    |--------------------------------------------------------------------------
    */

    Route::get('/feedbacks', [FeedbackController::class, 'index'])
        ->name('feedbacks.index');

    /*
    |--------------------------------------------------------------------------
    | Transfer Types
    |--------------------------------------------------------------------------
    */


    Route::get('/transfer-types/{type}/modal',
        [TransferTypeController::class, 'pressingSettingsModal']
    )->name('transfer-types.modal');

    Route::get('/transfer-types-search', [TransferTypeController::class, 'search'])
        ->name('transfer-types.search');

    Route::resource('transfer-types', TransferTypeController::class);

    /*
    |--------------------------------------------------------------------------
    | System Conversations
    |--------------------------------------------------------------------------
    */

    // Route::get('/feedbacks', [SystemConversationController::class, 'index'])
        // ->name('system-conversations.index');
    Route::resource('/feedbacks', SystemConversationController::class);
    Route::get('/feedbacks/done/{feedback}', [SystemConversationController::class, 'feedbackDone'])
        ->name('feedbacks.done');


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', fn () => view('settings.index'))
        ->name('settings.index');

    Route::get('/settings/backup', [CustomerController::class, 'backup'])
        ->name('settings.backup');

    /*
    |--------------------------------------------------------------------------
    | Profile (Breeze)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::resource('user', UserController::class);
});

require __DIR__.'/auth.php';
