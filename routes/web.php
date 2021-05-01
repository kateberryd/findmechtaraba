<?php

use App\Http\Controllers\LanguageController;
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

Auth::routes(['verify' => true]);

// Main Page Route
Route::get('/', 'AuthController@login_v2')->name('auth-login-v2');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::group(['prefix' => 'dashboard'], function () {
  Route::get('analytics', 'DashboardController@dashboardAnalytics')->name('dashboard-analytics');
  Route::get('ecommerce', 'DashboardController@dashboardEcommerce')->name('dashboard-ecommerce');
  Route::get('users', 'AdminController@index')->name('app-user-list');
  Route::get('all-users', 'AdminController@users');

});



Route::group(['prefix' => 'users'], function () {
  Route::get('dashboard', 'MotoristController@dashboard')->name('motorist-dashboard');
  Route::get('account-settings', 'MotoristController@account')->name('motorist-account');
  Route::get('profile', 'MotoristController@profile')->name('motorist-profile');
  Route::get('mechanics', 'MotoristController@findMechanic')->name('find-mechanic');
  Route::get('map/{id}', 'MotoristController@viewMap')->name('view-map');
  Route::post('account-settings', 'MotoristController@updateMotoristAccount')->name('motorist-account.post');

});

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
  Route::get('email', 'AppsController@emailApp')->name('app-email');
  Route::get('chat', 'AppsController@chatApp')->name('app-chat');
  Route::get('todo', 'AppsController@todoApp')->name('app-todo');
  Route::get('calendar', 'AppsController@calendarApp')->name('app-calendar');
  Route::get('kanban', 'AppsController@kanbanApp')->name('app-kanban');
  Route::get('invoice/list', 'AppsController@invoice_list')->name('app-invoice-list');
  Route::get('invoice/preview', 'AppsController@invoice_preview')->name('app-invoice-preview');
  Route::get('invoice/edit', 'AppsController@invoice_edit')->name('app-invoice-edit');
  Route::get('invoice/add', 'AppsController@invoice_add')->name('app-invoice-add');
  Route::get('invoice/print', 'AppsController@invoice_print')->name('app-invoice-print');
  Route::get('ecommerce/shop', 'AppsController@ecommerce_shop')->name('app-ecommerce-shop');
  Route::get('ecommerce/details', 'AppsController@ecommerce_details')->name('app-ecommerce-details');
  Route::get('ecommerce/wishlist', 'AppsController@ecommerce_wishlist')->name('app-ecommerce-wishlist');
  Route::get('ecommerce/checkout', 'AppsController@ecommerce_checkout')->name('app-ecommerce-checkout');
  Route::get('file-manager', 'AppsController@file_manager')->name('app-file-manager');
  Route::get('user/view', 'AppsController@user_view')->name('app-user-view');
  Route::get('user/edit', 'AppsController@user_edit')->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
  Route::get('typography', 'UserInterfaceController@typography')->name('ui-typography');
  Route::get('colors', 'UserInterfaceController@colors')->name('ui-colors');
});
/* Route UI */

/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
  Route::get('feather', 'UserInterfaceController@icons_feather')->name('icons-feather');
});
/* Route Icons */

/* Route Cards */
Route::group(['prefix' => 'card'], function () {
  Route::get('basic', 'CardsController@card_basic')->name('card-basic');
  Route::get('advance', 'CardsController@card_advance')->name('card-advance');
  Route::get('statistics', 'CardsController@card_statistics')->name('card-statistics');
  Route::get('analytics', 'CardsController@card_analytics')->name('card-analytics');
  Route::get('actions', 'CardsController@card_actions')->name('card-actions');
});
/* Route Cards */




Route::group(['prefix' => 'dashboard'], function () {
  Route::get('/', 'VendorController@index')->name('dashboard');
  Route::get('account-settings', 'AuthController@account_settings')->name('page-account-settings');
  Route::post('account-settings', 'AuthController@updateAccount')->name('account-setttings.post');
  Route::get('profile', 'VendorController@profile')->name('page-profile');
});

Route::group(['prefix' => 'auth'], function () {
  Route::get('login', 'AuthController@login_v2')->name('auth-login-v2');
  Route::post('login', 'AuthController@login')->name('login.post');
  Route::get('register', 'AuthenticationController@register_v2')->name('auth-register-v2');
  Route::post('register', 'AuthController@register')->name('register.post');
  Route::post('logout', 'AuthController@logout')->name('logout');


});
/* Route Authentication Pages */



Route::get('lang/{locale}', [LanguageController::class, 'swap']);
