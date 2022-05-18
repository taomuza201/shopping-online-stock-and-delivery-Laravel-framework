<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('/', [App\Http\Controllers\shopController::class, 'index']);

Route::get('/products-detail/{id}', [App\Http\Controllers\shopController::class, 'detail']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('comments/{id}', [App\Http\Controllers\commentsController::class, 'store'])->name('comments.store');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/top_user_sale', [App\Http\Controllers\showDashboardController::class, 'top_user_sale'])->name('top_user_sale');
    Route::get('/product_not_moving', [App\Http\Controllers\showDashboardController::class, 'product_not_moving'])->name('product_not_moving');
    Route::get('/hold_report', [App\Http\Controllers\HoldhistoryController::class, 'hold_report'])->name('hold_report');
});
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::post('/users', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');
    Route::get('/users/get/{id}', [App\Http\Controllers\UsersController::class, 'show'])->name('users.get');
    Route::post('/users/update/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.delete');

    Route::get('/tags', [App\Http\Controllers\TagsController::class, 'index'])->name('tags');
    Route::post('/tags', [App\Http\Controllers\TagsController::class, 'store'])->name('tags.store');
    Route::get('/tags/get/{id}', [App\Http\Controllers\TagsController::class, 'show'])->name('tags.get');
    Route::post('/tags/update/{id}', [App\Http\Controllers\TagsController::class, 'update'])->name('tags.update');
    Route::get('/tags/delete/{id}', [App\Http\Controllers\TagsController::class, 'destroy'])->name('tags.delete');

    Route::get('/proposal-list', [App\Http\Controllers\ProposalController::class, 'index'])->name('proposal.list');
    Route::get('/proposal-store', [App\Http\Controllers\ProposalController::class, 'store_page'])->name('proposal.store.page');
    Route::post('/proposal-store', [App\Http\Controllers\ProposalController::class, 'store'])->name('proposal.store');
    Route::post('/proposal-update/{id}', [App\Http\Controllers\ProposalController::class, 'update'])->name('proposal.update');
    Route::get('/proposal-detail/{id}', [App\Http\Controllers\ProposalController::class, 'show'])->name('proposal.detail');
    Route::post('/upload', [App\Http\Controllers\ProposalController::class, 'upload'])->name('upload');

    Route::get('/proposal-list-request', [App\Http\Controllers\Proposal_requestController::class, 'index'])->name('proposal.request.list');
    Route::get('/proposal-detail-request/{id}', [App\Http\Controllers\Proposal_requestController::class, 'show'])->name('proposal.request.detail');
    Route::get('/proposal-request-print/{id}', [App\Http\Controllers\Proposal_requestController::class, 'print'])->name('proposal.request.print');
    Route::get('/proposal-request-approve/{id}', [App\Http\Controllers\Proposal_requestController::class, 'approve'])->name('proposal.request.approve');
    Route::get('/proposal-request-none-approve/{id}', [App\Http\Controllers\Proposal_requestController::class, 'none'])->name('proposal.request.none');
    Route::get('/proposal-request-none-edit/{id}', [App\Http\Controllers\Proposal_requestController::class, 'edit'])->name('proposal.request.edit');

    Route::post('/upload-product', [App\Http\Controllers\ProductsController::class, 'upload'])->name('upload.product');

    Route::post('/upload-product-update', [App\Http\Controllers\ProductsController::class, 'upload_update'])->name('upload.product.update');

    Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
    Route::post('/products-store/{id}', [App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');
    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'list'])->name('products.list');
    Route::get('/products/edit/{id}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');

    Route::get('/products-owner', [App\Http\Controllers\Products_ownerController::class, 'index'])->name('products.owner.index');
    Route::get('/products-owner/{id}', [App\Http\Controllers\Products_ownerController::class, 'edit'])->name('products.owner.edit');
    Route::post('/products-owner/update/{id}', [App\Http\Controllers\Products_ownerController::class, 'update'])->name('products.owner.update');

    Route::get('comments/{id}', [App\Http\Controllers\commentsController::class, 'destroy'])->name('comments.destroy');

    Route::get('hold', [App\Http\Controllers\HoldController::class, 'index'])->name('hold.index');
    Route::get('hold-all', [App\Http\Controllers\HoldController::class, 'all'])->name('hold.all');

    Route::post('hold', [App\Http\Controllers\HoldController::class, 'store'])->name('hold.store');
    Route::get('hold-details/{id}', [App\Http\Controllers\HoldController::class, 'details'])->name('hold.details');
    Route::get('showproduct/{id}', [App\Http\Controllers\HoldController::class, 'showproduct'])->name('hold.showproduct');
    Route::get('showproduct_detail/{id}', [App\Http\Controllers\HoldController::class, 'showproduct_detail'])->name('hold.showproduct_detail');
    Route::post('store_details', [App\Http\Controllers\HoldController::class, 'store_details'])->name('hold.store_details');
    Route::post('update_details/{id}', [App\Http\Controllers\HoldController::class, 'update_details'])->name('hold.update_details');
    Route::get('delete/holddetail/{id}', [App\Http\Controllers\HoldController::class, 'delete_detail'])->name('hold.delete_detail');

    Route::get('hold/status/{status}/{id}', [App\Http\Controllers\HoldController::class, 'status'])->name('hold.status');
    Route::get('hold/blackstatus/{status}/{id}', [App\Http\Controllers\HoldController::class, 'blackstatus'])->name('hold.blackstatus');
    Route::get('/provinces/{id}', [App\Http\Controllers\HoldController::class, 'provinces'])->name('provinces');
    Route::get('/amphures/{id}', [App\Http\Controllers\HoldController::class, 'amphures'])->name('amphures');
    Route::get('/districts/{id}', [App\Http\Controllers\HoldController::class, 'districts'])->name('districts');
    Route::post('hold/upload_file_status/{status}/{id}', [App\Http\Controllers\HoldController::class, 'upload_file_status'])->name('hold.upload_file_status');
    Route::get('hold/printbill/{id}', [App\Http\Controllers\HoldController::class, 'printbill'])->name('hold.printbill');
    Route::get('hold/printdelivery/{id}', [App\Http\Controllers\HoldController::class, 'printdelivery'])->name('hold.printdelivery');

    Route::get('check_order/{id}', [App\Http\Controllers\HoldController::class, 'check_order'])->name('hold.check_order');

    Route::get('hold-histor', [App\Http\Controllers\HoldhistoryController::class, 'index'])->name('holdhistor.index');

    Route::get('post', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('post-add', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/post-store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::get('post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/post-store/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
});
Route::group(['middleware' => ['auth', 'productowner']], function () {
    Route::get('/proposal-list', [App\Http\Controllers\ProposalController::class, 'index'])->name('proposal.list');
    Route::get('/proposal-store', [App\Http\Controllers\ProposalController::class, 'store_page'])->name('proposal.store.page');
    Route::post('/proposal-store', [App\Http\Controllers\ProposalController::class, 'store'])->name('proposal.store');
    Route::post('/proposal-update/{id}', [App\Http\Controllers\ProposalController::class, 'update'])->name('proposal.update');
    Route::get('/proposal-detail/{id}', [App\Http\Controllers\ProposalController::class, 'show'])->name('proposal.detail');
    Route::post('/upload', [App\Http\Controllers\ProposalController::class, 'upload'])->name('upload');

    Route::get('/products-owner', [App\Http\Controllers\Products_ownerController::class, 'index'])->name('products.owner.index');
    Route::get('/products-owner/{id}', [App\Http\Controllers\Products_ownerController::class, 'edit'])->name('products.owner.edit');
    Route::post('/products-owner/update/{id}', [App\Http\Controllers\Products_ownerController::class, 'update'])->name('products.owner.update');

});

Route::group(['middleware' => ['auth', 'sale']], function () {
    Route::get('hold', [App\Http\Controllers\HoldController::class, 'index'])->name('hold.index');
    Route::get('hold-all', [App\Http\Controllers\HoldController::class, 'all'])->name('hold.all');

    Route::post('hold', [App\Http\Controllers\HoldController::class, 'store'])->name('hold.store');
    Route::get('hold-details/{id}', [App\Http\Controllers\HoldController::class, 'details'])->name('hold.details');
    Route::get('showproduct/{id}', [App\Http\Controllers\HoldController::class, 'showproduct'])->name('hold.showproduct');
    Route::get('showproduct_detail/{id}', [App\Http\Controllers\HoldController::class, 'showproduct_detail'])->name('hold.showproduct_detail');
    Route::post('store_details', [App\Http\Controllers\HoldController::class, 'store_details'])->name('hold.store_details');
    Route::post('update_details/{id}', [App\Http\Controllers\HoldController::class, 'update_details'])->name('hold.update_details');
    Route::get('delete/holddetail/{id}', [App\Http\Controllers\HoldController::class, 'delete_detail'])->name('hold.delete_detail');

    Route::get('hold/status/{status}/{id}', [App\Http\Controllers\HoldController::class, 'status'])->name('hold.status');
    Route::get('hold/blackstatus/{status}/{id}', [App\Http\Controllers\HoldController::class, 'blackstatus'])->name('hold.blackstatus');
    Route::get('/provinces/{id}', [App\Http\Controllers\HoldController::class, 'provinces'])->name('provinces');
    Route::get('/amphures/{id}', [App\Http\Controllers\HoldController::class, 'amphures'])->name('amphures');
    Route::get('/districts/{id}', [App\Http\Controllers\HoldController::class, 'districts'])->name('districts');
    Route::post('hold/upload_file_status/{status}/{id}', [App\Http\Controllers\HoldController::class, 'upload_file_status'])->name('hold.upload_file_status');
    Route::get('hold/printbill/{id}', [App\Http\Controllers\HoldController::class, 'printbill'])->name('hold.printbill');
    Route::get('hold/printdelivery/{id}', [App\Http\Controllers\HoldController::class, 'printdelivery'])->name('hold.printdelivery');

    Route::get('check_order/{id}', [App\Http\Controllers\HoldController::class, 'check_order'])->name('hold.check_order');

    Route::get('hold-histor', [App\Http\Controllers\HoldhistoryController::class, 'index'])->name('holdhistor.index');
});
