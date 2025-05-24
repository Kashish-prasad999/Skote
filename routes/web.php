<?php

use App\Http\Controllers\User\EcommerceController;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

//admin

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', "AuthController@login")->name('admin.login');
    Route::post('/dologin', "AuthController@doLogin")->name('admin.dologin');

    Route::get('/logout', "AuthController@destroy")->name('admin.logout');

    // permissions

    // Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions', 'PermissionController@index')->name('permissions.index');

    Route::get('permissions/create', 'PermissionController@create')->name('permissions.create');
    Route::post('permissions/create', 'PermissionController@store')->name('permissions.store');

    Route::get('permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::put('permissions/{permission}', 'PermissionController@update')->name('permissions.update');

    Route::get('permissions/{permissionId}/delete', 'PermissionController@destroy')->name('permissions.destroy');

    //  roles

    // Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles', 'RoleController@index')->name('roles.index');

    Route::get('roles/create', 'RoleController@create')->name('roles.create');
    Route::post('roles/create', 'RoleController@store')->name('roles.store');

    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update');

    Route::get('roles/{roleId}/delete', 'RoleController@destroy')->name('roles.destroy');

    Route::get('roles/{roleId}/give-permissions', 'RoleController@addPermissionToRole')->name('roles.permissions');
    Route::put('roles/{roleId}/give-permissions', 'RoleController@givePermissionToRole')->name('roles.give.permissions');

    //users and sellers and products and orders and edit-profile
    Route::get('users', 'DashboardController@user')->name('display.user');
    Route::get('sellers', 'DashboardController@seller')->name('display.seller');
    Route::get('products/{userId}', 'DashboardController@sellerProducts')->name('display.seller.products');
    Route::get('products', 'DashboardController@products')->name('admin.display.products');
    Route::get('orders/{userId}', 'DashboardController@userOrders')->name('admin.orders');
    Route::get('edit-profile/{userId}', 'DashboardController@editProfile')->name('admin.edit.profile');
    Route::put('update/{userId}', 'DashboardController@updateProfile')->name('admin.update.profile');


    //category
    Route::get('/category', 'CategoryController@index')->name('admin.category.list');

    Route::get('/category/create', 'CategoryController@create')->name('admin.category.create');
    Route::post('/category/create', 'CategoryController@store')->name('admin.category.store');

    Route::get('category/{category}/edit', 'CategoryController@edit')->name('admin.category.edit');
    Route::put('category/{category}', 'CategoryController@update')->name('admin.category.update');

    Route::get('category/{categoryId}/delete', 'CategoryController@destroy')->name('admin.category.destroy');

    // subcategory

    // without category

    Route::get('/subcategory/create', 'SubcategoryController@withoutcreate')->name('admin.subcategory.withoutcreate');
    Route::post('/subcategory/create', 'SubcategoryController@withoutstore')->name('admin.subcategory.withoutcreate.store');

    Route::get('/subcategory', 'SubcategoryController@index')->name('admin.subcategory.list');

    // with category

    Route::get('/subcategory/create/{categoryId}', 'SubcategoryController@create')->name('admin.subcategory.create');
    Route::post('/subcategory/create/{categoryId}', 'SubcategoryController@store')->name('admin.subcategory.create.store');

    Route::get('subcategory/{subcategory}/edit', 'SubcategoryController@edit')->name('admin.subcategory.edit');
    Route::put('subcategory/{subcategory}', 'SubcategoryController@update')->name('admin.subcategory.update');

    Route::get('subcategory/{subcategoryId}/delete', 'SubcategoryController@destroy')->name('admin.subcategory.delete');

    //discounts
    Route::get('/discount', 'DiscountController@index')->name('admin.discount.list');

    Route::get('/discount/create', 'DiscountController@create')->name('admin.discount.create');
    Route::post('/discount/create', 'DiscountController@store')->name('admin.discount.store');

    Route::get('discount/{discount}/edit', 'DiscountController@edit')->name('admin.discount.edit');
    Route::put('discount/{discount}', 'DiscountController@update')->name('admin.discount.update');

    Route::get('discount/{discountId}/delete', 'DiscountController@destroy')->name('admin.discount.destroy');

    //state
    Route::get('/state', 'StateController@index')->name('state.list');

    Route::get('/state/create', 'StateController@create')->name('state.create');
    Route::post('/state/create', 'StateController@store')->name('state.store');

    Route::get('state/{state}/edit', 'StateController@edit')->name('state.edit');
    Route::put('state/{state}', 'StateController@update')->name('state.update');

    Route::get('state/{stateId}/delete', 'StateController@destroy')->name('state.destroy');

    // city

    Route::get('/city', 'CityController@index')->name('city.list');

    Route::get('/city/create/{stateId}', 'CityController@create')->name('city.create');
    Route::post('/city/create/{stateId}', 'CityController@store')->name('city.store');

    Route::get('city/{city}/edit', 'CityController@edit')->name('city.edit');
    Route::put('city/{city}', 'CityController@update')->name('city.update');

    Route::get('city/{cityId}/delete', 'CityController@destroy')->name('city.delete');

    //order list
    Route::get('ecommerce/list', 'DashboardController@orderlist')->name('admin.order.list');

    Route::group(['middleware' => ['adminAuth']], function () {
        // dashboard
        Route::get('/', "DashboardController@dashboard")->name('admin.dashboard');
    });
});

//seller

Route::group(['prefix' => 'seller', 'namespace' => 'Seller'], function () {

    Route::get('/register', "RegisteredController@create")->name('seller.register');
    Route::post('/register', "RegisteredController@store")->name('seller.store');

    Route::get('/login', "AuthController@login")->name('seller.login');
    Route::post('/login', "AuthController@doLogin")->name('seller.dologin');

    Route::get('/logout', "AuthController@destroy")->name('seller.logout');

    // product
    // Route::get('myproducts', 'ProductController@index');
    // Route::delete('myproducts/{id}', 'ProductController@destroy');
    Route::get('myproductsDeleteAll', 'ProductController@deleteAll')->name('myproductsDeleteAll');

    Route::get('/add', 'ProductController@create')->name('add.product');
    Route::post('/add', 'ProductController@store')->name('store.product');

    Route::get('/display', 'ProductController@index')->name('display.product');

    Route::get('/edit/{product_id}', 'ProductController@edit')->name('edit.product');
    Route::put('/update/{product_id}', 'ProductController@update')->name('update.product');

    Route::get('/delete/{product_id}', 'ProductController@destroy')->name('delete.product');

    //category
    Route::get('/category', 'CategoryController@index')->name('category.list');

    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/category/create', 'CategoryController@store')->name('category.store');

    Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('category/{category}', 'CategoryController@update')->name('category.update');

    Route::get('category/{categoryId}/delete', 'CategoryController@destroy')->name('category.destroy');

    // subcategory

    // without category

    Route::get('/subcategory/create', 'SubcategoryController@withoutcreate')->name('subcategory.withoutcreate');
    Route::post('/subcategory/create', 'SubcategoryController@withoutstore')->name('subcategory.withoutcreate.store');

    Route::get('/subcategory', 'SubcategoryController@index')->name('subcategory.list');

    // with category

    Route::get('/subcategory/create/{categoryId}', 'SubcategoryController@create')->name('subcategory.create');
    Route::post('/subcategory/create/{categoryId}', 'SubcategoryController@store')->name('subcategory.store');

    Route::get('subcategory/{subcategory}/edit', 'SubcategoryController@edit')->name('subcategory.edit');
    Route::put('subcategory/{subcategory}', 'SubcategoryController@update')->name('subcategory.update');

    Route::get('subcategory/{subcategoryId}/delete', 'SubcategoryController@destroy')->name('subcategory.delete');

    Route::group(['middleware' => ['sellerAuth']], function () {
        // dashboard
        Route::get('/', "DashboardController@dashboard")->name('seller.dashboard');
    });
});

//user

Route::group(['namespace' => 'User'], function () {
    Route::get('/login', "AuthController@login")->name('user.login');
    Route::post('/login', "AuthController@doLogin")->name('user.dologin');
    // 'throttle:6,1'
    Route::get('/logout', "AuthController@destroy")->name('user.logout');

    Route::get('/register', "RegisteredController@create")->name('user.register');
    Route::post('/register', "RegisteredController@store")->name('user.store');


    // ecommerce

    Route::get('/', 'EcommerceController@index')->name('index');
    // Route::get('/', [EcommerceController::class, 'index'])->name('index');
    Route::get('/filters/{catid}/{subcat}', 'EcommerceController@filters')->name('filters');

    Route::get('/category/{catid}/', 'EcommerceController@category')->name('category');

    Route::get('ecommerce/details/{productId}', 'EcommerceController@details')->name('product.details');

    Route::post('ecommerce/shipping/', 'ShippingController@store')->name('shipping.store');

    Route::get('shipping/edit/{shipId}', 'ShippingController@edit')->name('shipping.edit');
    Route::put('shipping/edit/{shipId}', 'ShippingController@update')->name('shipping.update');

    //cart
    Route::get('ecommerce/cart/{productId}', 'CartController@addtoCart')->name('add.cart');
    Route::get('ecommerce/cart/', 'CartController@cartList')->name('cart.list');
    Route::patch('update-cart', 'CartController@updates')->name('update.cart'); //session

    Route::put('/cart/{id}/update', 'CartController@update')->name('cart.update');

    Route::delete('remove-from-cart', 'CartController@remove')->name('remove.from.cart'); //session
    Route::get('/cart/{id}/remove', 'CartController@destroy')->name('cart.destroy');

    Route::get('ecommerce/payment/{total}', 'ShippingController@cartPayment')->name('cart.payment');
    // Route::get('ecommerce/payment/{shipId}/{total}','ShippingController@payment')->name('payment');

    Route::get('ecommerce/order/{total}/{req}/{transactionId}', 'OrderController@cartOrder')->name('cart.order');
    // Route::post('ecommerce/order/', 'OrderController@cartOrder')->name('cart.order');

    Route::post('payment/{total}/{transactionId}', 'OrderController@cartPaymentMethod')->name('payment.method');
    // Route::get('card/order/{total}','OrderController@cardCreate')->name('card');
    Route::get('card/order/', 'OrderController@cardStore')->name('card'); //extra


    //buy now

    Route::get('ecommerce/payment/{total}/{productId}', 'ShippingController@payment')->name('payment');
    Route::post('payment/{total}/{productId}/{transactionId}', 'OrderController@paymentMethod')->name('buy.payment.method');

    // Route::get('ecommerce/order/{total}/{req}/{productId}/{transactionId}', 'OrderController@order')->name('order');

    Route::get('ecommerce/order', 'OrderController@order')->name('order');
    Route::get('ecomm', 'OrderController@extra')->name('ord');

    // //payment gateway for buynow
    // Route::get('create-transaction/{total}/{req}/{productId}/{transactionId}', 'PayPalController@createTransaction')->name('createTransaction');
    // Route::get('process-transaction/{total}/{req}/{productId}/{transactionId}', 'PayPalController@processTransaction')->name('processTransaction');
    // Route::get('success-transaction/{total}/{req}/{productId}/{transactionId}', 'PayPalController@successTransaction')->name('successTransaction');
    // Route::get('cancel-transaction/{total}/{req}/{productId}/{transactionId}', 'PayPalController@cancelTransaction')->name('cancelTransaction');

    //price filter

    Route::get('/products/filter-by-price', 'EcommerceController@filterByPrice')->name('product.filter-by-price');

    // searchbar

    Route::get('/search', 'EcommerceController@search')->name('products.search');

    // //payment gateway
    // Route::get('create-transaction/{total}/{req}/{transactionId}', 'PayPalController@createTransactions')->name('createTransactions');
    // Route::get('process-transaction/{total}/{req}/{transactionId}', 'PayPalController@processTransactions')->name('processTransactions');
    // Route::get('success-transaction/{total}/{req}/{transactionId}', 'PayPalController@successTransactions')->name('successTransactions');
    // Route::get('cancel-transaction/{total}/{req}/{transactionId}', 'PayPalController@cancelTransactions')->name('cancelTransactions');


    // Route::get('payment/paypal/', 'PaymentController@paypal')->name('payment.paypal');
    // Route::post('payment/paypal', 'PaymentController@paypalPayment')->name('payment.paypal.payment');

    //     Route::post('/paypal', 'PaymentController@payWithpaypal')->name('paypal');

    // // route for check status of the payment
    // Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');



    Route::group(['middleware' => ['userAuth']], function () {
        // dashboard
        Route::get('/dashboard', "DashboardController@dashboard")->name('user.dashboard');

        Route::get('ecommerce/checkout/', 'ShippingController@checkout')->name('checkout');
        // Route::get('ecommerce/checkout/{productId}', 'ShippingController@checkout')->name('checkout');

        Route::get('ecommerce/shipping/', 'ShippingController@create')->name('shipping');

        Route::get('shipping/', 'ShippingController@addNew')->name('add.new');
        Route::post('shipping/', 'ShippingController@addNewStore')->name('store.new');

        Route::get('ecommerce/list', 'OrderController@orderlist')->name('order.list');

        Route::get('buynow/{productId}', 'EcommerceController@buyNow')->name('buy.now');
        Route::get('checkout/{productId}', 'ShippingController@checkoutBuy')->name('checkout.buy');
    });
});
