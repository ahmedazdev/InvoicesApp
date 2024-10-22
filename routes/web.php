<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);
Route::resource('section', SectionController::class);
Route::resource('product', ProductController::class);

Route::get('/sections/{id}',[InvoiceController::class,'getProducts']);
Route::get('/invoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file'])->name('view_file');
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::get('/edit_invoice/{id}', [InvoiceController::class,'edit']);

Route::get('/Status_show/{id}', [InvoiceController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [InvoiceController::class,'Status_Update'])->name('Status_Update');




Route::get('Invoice_Paid',[InvoiceController::class,'Invoice_Paid']);

Route::get('Invoice_UnPaid',[InvoiceController::class,'Invoice_UnPaid']);

Route::get('Invoice_Partial',[InvoiceController::class,'Invoice_Partial']);




Route::get('/{page}', [AdminController::class, 'index']);
