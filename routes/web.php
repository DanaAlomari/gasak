<?php

use App\Http\Controllers\Backend\Admin\AdminDashboardController;
use App\Http\Controllers\Backend\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Admin\ContactUsController;
use App\Http\Controllers\Backend\Admin\MainCategoryController;
use App\Http\Controllers\Backend\Admin\OrderController;
use App\Http\Controllers\Backend\Admin\ProductController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Frontend\FrontEndController;
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
    return view('front_end_files.about');
})->name('about');

Route::get('/contact', function () {
    return view('front_end_files.contact');
})->name('contact');

// Route::get('/checkout', function () {
//     return view('front_end_files.checkout');
// })->name('checkout');

Route::get('/gas', function () {
    return view('front_end_files.gas');
})->name('gas');


// Route::get('/services', function () {
//     return view('front_end_files.services');
// })->name('services');
Route::get('/product_details/{id}', [FrontEndController::class, 'product_details'])->name('product_details');
Route::get('/', [FrontEndController::class, 'welcome'])->name('welcome');
Route::get('/services', [FrontEndController::class, 'services'])->name('services');
Route::post('/createServices', [FrontEndController::class, 'createServices'])->name('createServices');

Route::get('/products/{category_id?}', [FrontEndController::class, 'products'])->name('products');

Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('/register', [FrontEndController::class, 'register'])->name('register');
    Route::post('/register', [FrontEndController::class, 'register_submit'])->name('register_customer.submit');
    Route::get('/login', [FrontEndController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FrontEndController::class, 'login'])->name('login_customer.submit');
    Route::get('/logout', [FrontEndController::class, 'logout'])->name('logout');
    Route::post('/addToCart', [FrontEndController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/updateCart', [FrontEndController::class, 'updateCart'])->name('updateCart');
    Route::get('/deleteFromCart/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delete-from-cart');
    Route::get('/profile', [FrontEndController::class, 'profile'])->name('profile');
    Route::get('/cart', [FrontEndController::class, 'cart'])->name('cart');
    Route::post('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
    Route::get('/checkoutPage', [FrontEndController::class, 'checkoutPage'])->name('checkoutPage');
    Route::post('/update-profile', [FrontEndController::class, 'updateProfile'])->name('update-profile');
    Route::post('/getOrder-details', [FrontEndController::class, 'getOrderDetails'])->name('getOrderDetails');
});



// ==================================================================================================================
// =========================================== Super Admin Routes ===================================================
// ==================================================================================================================
Route::prefix('super_admin')->name('super_admin.')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth:super_admin','CheckSuperAdmin']], function () {
        // Dashboard Route :
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');



        // User Routes :
        // ==============================================================================
        Route::group(['prefix' => 'users'], function () {
            Route::get('/create', [UserController::class, 'create'])->name('users-create');
            Route::post('/store', [UserController::class, 'store'])->name('users-store');
            Route::get('/index', [UserController::class, 'index'])->name('users-index');
            Route::get('show/{id}', [UserController::class, 'show'])->name('users-show');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('users-edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('users-update');
            Route::get('/activeInactiveSingle/{id}/{user_type}', [UserController::class, 'activeInactiveSingle'])->name('users-activeInactiveSingle');
        });



        // Main Category Routes :
        // ==============================================================================
        Route::group(['prefix' => 'main-categories'], function () {
            Route::get('/create', [MainCategoryController::class, 'create'])->name('mainCategories-create');
            Route::post('/store', [MainCategoryController::class, 'store'])->name('mainCategories-store');
            Route::get('/index', [MainCategoryController::class, 'index'])->name('mainCategories-index');
            Route::get('edit/{id}', [MainCategoryController::class, 'edit'])->name('mainCategories-edit');
            Route::post('update/{id}', [MainCategoryController::class, 'update'])->name('mainCategories-update');
            Route::get('activeInactiveSingle/{id}', [MainCategoryController::class, 'activeInactiveSingle'])->name('mainCategories-activeInactiveSingle');
            Route::get('destroy/{id}', [MainCategoryController::class, 'destroy'])->name('mainCategories-destroy');
        });


        // Product Routes :
        // ==============================================================================
        Route::group(['prefix' => 'products'], function () {
            Route::get('/create', [ProductController::class, 'create'])->name('products-create');
            Route::post('/store', [ProductController::class, 'store'])->name('products-store');
            Route::get('/index', [ProductController::class, 'index'])->name('products-index');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products-edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('products-update');
            Route::get('activeInactiveSingle/{id}', [ProductController::class, 'activeInactiveSingle'])->name('products-activeInactiveSingle');
            Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('products-destroy');
        });




        // Contact Us Routes :
        // ==============================================================================
        Route::group(['prefix' => 'contact_us-store'], function () {
            Route::get('/index', [ContactUsController::class, 'index'])->name('contact_us-index');
            Route::get('edit', [ContactUsController::class, 'edit'])->name('contact_us-edit');
            Route::post('update', [ContactUsController::class, 'update'])->name('contact_us-update');

            //Contact Us Requests
            Route::get('/requests', [ContactUsController::class, 'requests'])->name('contact_us-requests');
            Route::get('showRequest/{id}', [ContactUsController::class, 'showRequest'])->name('contact_us-showrequest');
            Route::get('destroy/{id}', [ContactUsController::class, 'destroyRequest'])->name('contact_us-destroyrequest');
        });



        Route::group(['prefix' => 'orders'], function () {
            Route::get('/index', [OrderController::class, 'index'])->name('orders-index');
            Route::get('show/{id}', [OrderController::class, 'show'])->name('orders-show');
        });


    });
});
