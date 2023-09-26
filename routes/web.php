<?php
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\AdminLogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
//admin login
use App\Http\Livewire\Adminauth\AdminLogin;

use App\Http\Livewire\Adminauth\Passwords\AdminConfirm;
use App\Http\Livewire\Adminauth\Passwords\AdminEmail;
use App\Http\Livewire\Adminauth\Passwords\AdminReset;
use App\Http\Livewire\Adminauth\AdminRegister;
use App\Http\Livewire\Adminauth\AdminVerify;
use App\Http\Livewire\AdminDashboard;
//user
use App\Http\Livewire\AddUser;
use App\Http\Livewire\EditUser;
use App\Http\Livewire\UserList;
//product
use App\Http\Livewire\AddProduct;
use App\Http\Livewire\ProductList;
use App\Http\Livewire\EditProduct;
//Category
use App\Http\Livewire\Category\Category;
//Brand
use App\Http\Livewire\Brands\Brands;
//warehouse
use App\Http\Livewire\Warehouses\Warehouses;
//Item
use App\Http\Livewire\Item\Item;
use App\Http\Livewire\Item\UserItemList;
use App\Http\Livewire\UploadFile;

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

Route::view('/', 'welcome')->name('home');

Route::controller(UserManagementController::class)->group(function () {
    Route::get('test/{id?}','test')->name('test');
    Route::get('progress/{id?}','progress')->name('progress');
    Route::get('findBatch1/{id?}','findBatch')->name('findBatch');
    Route::get('generateBarcode/{id?}','generateBarcode')->name('generateBarcode');
});

Route::get('findBatch', [ProductList::class, 'findBatch'])->name('findBatch');
Route::get('get-pending-job-batches', [ProductList::class, 'getPendingJobBatches'])->name('get-pending-job-batches');

//user routes
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('password/reset', Email::class)->name('password.request');
    Route::get('password/reset/{token}', Reset::class)->name('password.reset');
});
Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');
    Route::get('password/confirm', Confirm::class)->name('password.confirm');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');
});
//end user routes

//admin rotues
    Route::group(['middleware' => ['guest:admin'],'prefix'=>'admin','as'=>'admin.'],function(){
        Route::get('login', AdminLogin::class)->name('login');
        Route::get('password/reset', AdminEmail::class)->name('password.request');
        Route::get('password/reset/{token}', AdminReset::class)->name('password.reset');
    });
    
    Route::group(['middleware' => ['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function(){
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/upload-file', UploadFile::class)->name('upload-file');
        Route::get('/', AdminDashboard::class);        
        Route::post('logout', AdminLogoutController::class)->name('logout');
        //user        
        Route::get('add-user', AddUser::class)->name('add-user');
        Route::get('user-list', UserList::class)->name('user-list');
        Route::get('edit-user/{id}', EditUser::class)->name('edit-user');
        Route::get('item-list/{id?}', UserItemList::class)->name('item-list');
        // Route::controller(UserList::class)->group(function () {
        //     Route::get('item-list','getItem')->name('item-list');
        // }); 
        //products
        // Route::controller(AddProduct::class)->group(function () {
        //     Route::get('product-list','productList')->name('product-list');
        // });    
        //products
        Route::get('add-product', AddProduct::class)->name('add-product');
        Route::get('product-list', ProductList::class)->name('product-list');
        Route::get('edit-product/{id}', EditProduct::class)->name('edit-product');
        //Category
        Route::get('category', Category::class)->name('category');
        //Brand
        Route::get('brand', Brands::class)->name('brand');
        //Warehouses
        Route::get('warehouse', Warehouses::class)->name('warehouse'); 

        //item
        Route::get('item', Item::class)->name('item'); 
    });   
//end admin routes

