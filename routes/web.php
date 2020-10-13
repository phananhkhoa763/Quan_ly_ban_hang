<?php
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

Route::get('kk', function () {
    return view('frontend.blocks.error-404');
});
Route::group([
    'namespace' => 'Frontend',
], function () {
    Route::get('blog/index', 'blog\BlogController@index')->name('frontend.blog.index');
    // home page
    Route::get('/', 'homepage\HomepageController@index')->name('frontend.index');
    Route::get('index/category/{id}', 'homepage\HomepageController@SeachCategory')->name('frontend.index.category');
    Route::get('index/brand/{id}', 'homepage\HomepageController@SeachBrand')->name('frontend.index.brand');
    Route::get('index/searchName', 'homepage\HomepageController@searchName')->name('frontend.index.searchName');
    Route::get('PriceRange', 'homepage\HomepageController@Ajax_PriceRange')->name('frontend.index.searchName');
    // add Session Wishlist
    Route::get('/Wishlist', 'homepage\HomepageController@Wishlist_add')->name('frontend.Wishlist.add');
    Route::get('/Wishlist/delete', 'homepage\HomepageController@Wishlist_delete')->name('frontend.Wishlist.delete');
    Route::get('/Wishlist/show', 'homepage\HomepageController@Wishlist_show')->name('frontend.Wishlist.show');
    Route::get('/Cart/add', 'homepage\HomepageController@Cart_add')->name('frontend.Cart.add');
    Route::get('/Cart/show', 'homepage\HomepageController@Cart_show')->name('frontend.Cart.show');
    Route::get('/Cart/calculation', 'homepage\HomepageController@Cart_calculation')->name('frontend.Cart.calculation');
    Route::get('/Cart/total', 'homepage\HomepageController@Cart_total')->name('frontend.Cart.total');
    Route::get('/Cart/delete', 'homepage\HomepageController@Cart_delete')->name('frontend.Cart.delete');
    Route::get('/mail', 'homepage\HomepageController@sendMail')->name('frontend.Cart.sendMail');

    Route::group([
        'prefix' => 'member',
    ], function () {
        Route::get('login', 'MemberController@showLogin')->name('frontend.login.showLogin');
        Route::post('loginMember', 'MemberController@login')->name('frontend.checkLogin.member');
        Route::get('registerMember', 'MemberController@create')->name('frontend.login.registerMember');
        Route::post('memberlogout', 'MemberController@logout')->name('frontend.memberlogout');
    });
});
//
Route::group([
    'prefix' => '/',
    'namespace' => 'Frontend',
    'middleware' => ['auth.member'],
], function () {
    Route::get('blog/blog-single/{id}', 'blog\BlogController@show')->name('frontend.blog.show');
    Route::get('blog/rate', 'rate\RateController@create')->name('frontend.rate.create');
    Route::get('blog/comment', 'comment\CommentController@create')->name('frontend.comment.create');
    Route::get('profile', 'MemberProfileController@show')->name('frontend.profile');
    Route::post('profile/update/{id}', 'MemberProfileController@update')->name('frontend.profile.update');
    //product
    Route::get('product/index', 'product\ProductController@index')->name('frontend.product.index');
    Route::get('product/create', 'product\ProductController@create')->name('frontend.product.create');
    Route::post('product/store', 'product\ProductController@store')->name('frontend.product.store');
    Route::get('product/edit/{id}', 'product\ProductController@edit')->name('frontend.product.edit');
    Route::post('product/update/{id}', 'product\ProductController@update')->name('frontend.product.update');
    Route::get('product/destroy/{id}', 'product\ProductController@destroy')->name('frontend.product.destroy');
});


Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {

    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', ' RegisterController@register');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin']

], function () {
    Route::get('/home', 'ControllerMenu@index')->name('home');

    // menu
    Route::get('formbasic', 'ControllerMenu@formbasic')->name('menu.formbasic');
    Route::get('iconmaterial', 'ControllerMenu@iconmaterial')->name('menu.iconmaterial');
    Route::get('pagesprofile', 'ControllerMenu@pagesprofile')->name('menu.pagesprofile');
    Route::get('tablebasic', 'ControllerMenu@tablebasic')->name('menu.tablebasic');
    // route country
    Route::get('country/index', 'Country\CountryController@index')->name('admin.country.index');
    Route::post('country/store', 'Country\CountryController@store')->name('admin.country.store');
    Route::get('country/export', 'Country\CountryController@export')->name('admin.country.export');
    Route::post('country/import', 'Country\CountryController@import')->name('admin.country.import');
    // end route country

    //route user
    Route::get('user/index', 'AdminController@index')->name('admin.user.index');
    Route::post('user/update/{id}', 'AdminController@update')->name('admin.user.update');
    // route bolg
    Route::get('blog/index', 'blog\BlogController@index')->name('admin.blog.index');
    Route::get('blog/create', 'blog\BlogController@create')->name('admin.blog.create');
    Route::post('blog/store', 'blog\BlogController@store')->name('admin.blog.store');
    Route::get('blog/edit/{id}', 'blog\BlogController@edit')->name('admin.blog.edit');
    Route::post('blog/update/{id}', 'blog\BlogController@update')->name('admin.blog.update');
    Route::get('blog/destroy/{id}', 'blog\BlogController@destroy')->name('admin.blog.destroy');
});
