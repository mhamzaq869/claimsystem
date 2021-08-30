<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('user/login', 'FrontendController@login')->name('login.form');
Route::post('user/login', 'FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout', 'FrontendController@logout')->name('user.logout');

Route::get('user/register', 'FrontendController@register')->name('register.form');
Route::post('user/register', 'FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::get('password-reset', 'FrontendController@showResetForm')->name('password.reset');
// Socialite
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/', 'FrontendController@home')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us', 'FrontendController@aboutUs')->name('about-us');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::post('/contact/message', 'MessageController@store')->name('contact.store');
Route::get('product-detail/{slug}', 'FrontendController@productDetail')->name('product-detail');
Route::post('/product/search', 'FrontendController@search')->name('product.search');
Route::get('/product-cat/{slug}', 'FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}', 'FrontendController@productSubCat')->name('product-sub-cat');
Route::get('/product-brand/{slug}', 'FrontendController@productBrand')->name('product-brand');

// Cart section
Route::get('/add-to-cart/{slug}', 'CartController@addToCart')->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart', 'CartController@singleAddToCart')->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}', 'CartController@cartDelete')->name('cart-delete');
Route::post('cart-update', 'CartController@cartUpdate')->name('cart.update');

Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout', 'CartController@checkout')->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist', function () {
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}', 'WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}', 'WishlistController@wishlistDelete')->name('wishlist-delete');
Route::post('cart/order', 'OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}', 'OrderController@pdf')->name('order.pdf');
Route::get('/income', 'OrderController@incomeChart')->name('product.order.income');
// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids', 'FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists', 'FrontendController@productLists')->name('product-lists');
Route::match(['get', 'post'], '/filter', 'FrontendController@productFilter')->name('shop.filter');
// Order Track
Route::get('/product/track', 'OrderController@orderTrack')->name('order.track');
Route::post('product/track/order', 'OrderController@productTrackOrder')->name('product.track.order');
// Blog
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}', 'FrontendController@blogDetail')->name('blog.detail');
Route::get('/blog/search', 'FrontendController@blogSearch')->name('blog.search');
Route::post('/blog/filter', 'FrontendController@blogFilter')->name('blog.filter');
Route::get('blog-cat/{slug}', 'FrontendController@blogByCategory')->name('blog.category');
Route::get('blog-tag/{slug}', 'FrontendController@blogByTag')->name('blog.tag');

// NewsLetter
Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');

// Product Review
Route::resource('/review', 'ProductReviewController');
Route::post('product/{slug}/review', 'ProductReviewController@store')->name('review.store');

// Post Comment
Route::post('post/{slug}/comment', 'PostCommentController@store')->name('post-comment.store');
Route::resource('/comment', 'PostCommentController');
// Coupon
Route::post('/coupon-store', 'CouponController@couponStore')->name('coupon-store');
// Payment
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');

//  Order
Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');


// Backend section start

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/file-manager', function () {
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users', 'UsersController');
    // Banner
    Route::resource('banner', 'BannerController');
    // Brand
    Route::resource('brand', 'BrandController');
    // Profile
    Route::get('/profile', 'AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}', 'AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category', 'CategoryController');
    // Product
    Route::resource('/product', 'ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
    // POST category
    Route::resource('/post-category', 'PostCategoryController');
    // Post tag
    Route::resource('/post-tag', 'PostTagController');
    // Post
    Route::resource('/post', 'PostController');
    // Message
    Route::resource('/message', 'MessageController');
    Route::get('/message/five', 'MessageController@messageFive')->name('messages.five');
    // Order
    Route::resource('/order', 'OrderController');
    // Shipping
    Route::resource('/shipping', 'ShippingController');
    // Coupon
    Route::resource('/coupon', 'CouponController');
    // Settings
    Route::get('settings', 'AdminController@settings')->name('settings');
    Route::post('setting/update', 'AdminController@settingsUpdate')->name('settings.update');

    // projects
    Route::get('projects', 'admin\GeneralController@projects')->name('admin.view.projects');
    Route::get('bids/{id?}', 'admin\GeneralController@bids')->name('admin.view.bids');
    Route::get('contracts/{id?}', 'admin\GeneralController@contracts')->name('admin.view.contracts');

    // payments
    Route::get('payement/request', 'admin\GeneralController@payemntRequest')->name('admin.payment.request');
    Route::post('payement/accept', 'admin\GeneralController@accPaymentRequest')->name('admin.payment.accept');
    Route::get('payement/transaction', 'admin\GeneralController@paymentTrans')->name('admin.payment.trans');




    // Notification
    Route::get('/notification/{id}', 'NotificationController@show')->name('admin.notification');
    Route::get('/notifications', 'NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}', 'NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('admin.change.password');
});










// User section start
Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::get('/', 'HomeController@index')->name('user');
    // Profile
    Route::get('/profile', 'HomeController@profile')->name('user-profile');
    Route::post('/profile/{id}', 'HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}', 'logooller@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}', 'HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}', 'HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}', 'HomeController@productReviewUpdate')->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment', 'HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}', 'HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}', 'HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}', 'HomeController@userCommentUpdate')->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

    // Projects
    Route::get('project', 'ProjectController@index')->name('user.project');
    Route::get('project/create', 'ProjectController@create')->name('user.project.create');
    Route::post('project/store', 'ProjectController@store')->name('user.project.store');
    Route::get('project/edit/{id}', 'ProjectController@edit')->name('user.project.edit');
    Route::post('project/{id}/update', 'ProjectController@update')->name('user.project.update');
    Route::delete('project/{id}/delete', 'ProjectController@destroy')->name('user.project.delete');
    Route::post('project/upload', 'ProjectController@upload')->name('user.project.upload');

    //proposal or bids recieve
    Route::get('proposal/{id}/recive', 'ProjectController@proposalRecive')->name('proposal.recive');
    Route::post('proposal/accept', 'ProjectController@proposalAccept')->name('proposal.accept');
    Route::post('proposal/bidaccept', 'ProjectController@bidProposalAccept')->name('bid.proposal.accept');
    Route::get('contract/{id}', 'ProjectController@Contract')->name('contract.view');

    // Review Vendor
    Route::post('reject-work', 'ProjectController@rejectSubmitWork')->name('reject.submit.work');
    Route::post('review-vendor', 'ProjectController@acceptSubmitWork')->name('user.review');
    Route::get('fetchBider/{id}','ProjectController@fetchBiderUserToChat');

});

// Realtime Chat messages
// Route::get('messages/{id}', 'ProjectController@fetchMessages');
// Route::post('messages', 'ProjectController@sendMessage');


Route::get('/messages','ProjectController@message');
Route::get('messages/{id}/{project?}', 'ProjectController@chat');
Route::get('/getChatMessages/{id}/{to}','ProjectController@fetchMessages');
Route::post('sendMessages','ProjectController@sendMessages');
Route::post('/sendOffer', 'ProjectController@sendOfferMessage');
// Route::post('messages', 'ProjectController@fetchMessages');



Route::get('all-vendors', 'FrontendController@showAllVendors')->name('vendor.view');
Route::post('search-vendors', 'FrontendController@vendorSearch')->name('vendor.search');
Route::get('view-vendor/{id}', 'FrontendController@viewVendor')->name('vendor.single');

// vendors
Route::group(['prefix' => '/vendor', 'middleware' => ['auth', 'vendor']], function () {

    Route::get('vendor-products/{id}', 'FrontendController@vendorAllProducts')->name('vendor.products');
    Route::get('vendor-profile/{id}', 'FrontendController@vendorAllProfile')->name('vendor.profile');
    Route::get('projects', 'VendorController@Projects')->name('vendor.projects');
    Route::post('projects-search', 'VendorController@searchProjects')->name('vendor.search.projects');
    Route::get('project-detail/{id}', 'VendorController@projectDetail')->name('vendor.project.detail');
    Route::get('order-status', 'VendorController@orderStatus')->name('vendor.order.status');
    Route::get('bids', 'VendorController@bidOnProject')->name('vendor.bids.project');
    Route::post('bid', 'VendorController@bidingOnProject')->name('vendor.biding.project');
    Route::get('earning', 'VendorController@earning')->name('vendor.earning');

    //products
    Route::resource('/products', 'VendorProductController');

    //Submit Work
    Route::post('/submit-work', "VendorController@submitWork")->name('vendor.deliver');


    Route::get('/order/received', "VendorController@receiveOrders")->name('vendor.order.received');
    Route::get('/order/receivedshow/{id}', "VendorController@receiveOrdersShow")->name('order.received.show');
    Route::get('/order/receivededit/{id}', "VendorController@receiveOrdersEdit")->name('order.received.edit');
    Route::patch('/order/receivedupdate/{id}', "VendorController@receiveOrdersUpdate")->name('order.received.update');
    Route::delete('/order/receiveddelete/{id}', "VendorController@receiveOrdersdestroy")->name('order.received.delete');

    //Withdraw
    Route::post('/withdraw', "VendorController@withdrawn")->name('vendor.withdraw');
    Route::post('/order-withdraw', "VendorController@withdrawn")->name('vendor.order.withdraw');

    //bank
    Route::get('/viewbank', "VendorController@viewBank")->name('vendor.viewbank');
    Route::post('/addbank', "VendorController@addBank")->name('vendor.bank');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
