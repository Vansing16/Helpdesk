<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TechnicalController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;


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
// Route::get('/', function () {
//   return phpinfo();
// });


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('admin/setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::post('admin/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


    Route::get('admin/search', [SearchController::class, 'search'])->name('admin.search');
    
    Route::get('admin/ticket', [TicketController::class, 'ticket'])->name('admin.ticket');
    Route::get('admin/ticket/view_ticket/{id}', [TicketController::class, 'view_ticket'])->name('admin.ticket.view_ticket');
    Route::get('admin/ticket/edit_ticket/{id}', [TicketController::class, 'edit_ticket'])->name('admin.ticket.edit_ticket');
    Route::post('admin/ticket/update_ticket/{id}', [TicketController::class, 'update_ticket'])->name('admin.ticket.update_ticket');
    Route::get('admin/ticket/delete_ticket/{id}', [TicketController::class, 'delete_ticket'])->name('admin.ticket.delete_ticket');
   
    
    Route::get('admin/technical', [TechnicalController::class, 'index'])->name('admin.technical');
    Route::get('admin/technical/add_technical', [TechnicalController::class, 'addTechnical'])->name('admin.technical.add_technical');
    Route::post('admin/technical/store_technician', [TechnicalController::class, 'storeTechnical'])->name('admin.technical.save-agent');
    Route::get('admin/technical/view_technical/{id}', [TechnicalController::class, 'viewTechnical'])->name('admin.technical.view_technical');
    Route::get('admin/technical/edit_technical/{id}', [TechnicalController::class, 'editTechnical'])->name('admin.technical.edit_technical');
    Route::post('admin/technical/update_technical/{id}', [TechnicalController::class, 'updateTechnical'])->name('admin.technical.update_technical');
    Route::get('admin/technical/delete_technical/{id}', [TechnicalController::class, 'deleteTechnical'])->name('admin.technical.delete_technical');

    Route::get('admin/customer', [CustomerController::class, 'customer'])->name('admin.customer');
    Route::get('admin/customer/view_customer/{id}', [CustomerController::class, 'view_customer'])->name('admin.customer.view_customer');
    Route::get('admin/customer/delete_customer/{id}', [CustomerController::class, 'delete_customer'])->name('admin.customer.delete_customer');
    
});

require __DIR__.'/auth.php';
