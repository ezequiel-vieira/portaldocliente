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
Route::get('login-empresarial', function()
{
    return view('auth.login2');
});

// Registration Routes...
Route::get('registar', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);

Route::get('/faq', 'HomeController@showFaq');
 
/* TEMP ROUTES*/
Route::get('/catalogo-cart', 'HomeController@getCatalogoFiltered2');
Route::get('cart3', 'HomeController@cart3');
Route::post('/cliente/encomenda3/', 'HomeController@saveEncomenda3')->name('saveEncomenda3');
Route::get('/catalogo-cart/pesquisa', 'HomeController@getCatalogoFiltered2');
/* TEMP ROUTES*/

/////////////////////////////////////////////////////////////////////////////////////////////////
/* SHOPPING CART - ROUTES*/
Route::get('/catalogo', 'HomeController@getCatalogoFiltered');
Route::get('/search/{query_string}/', 'HomeController@getCatalogoFiltered');
Route::get('cart', 'HomeController@cart');
Route::get('add-to-cart/{id}/{quantity}', 'HomeController@addToCart2');
Route::patch('update-cart', 'HomeController@updateCart');
Route::delete('remove-from-cart', 'HomeController@remove2');
Route::post('/cliente/encomenda/', 'HomeController@saveEncomenda2')->name('saveEncomenda2');
//////////////////////////////////////////////////////////////////
/* DISABLE DEBUG BAR */
Config::set('debugbar.enabled', false);

/******************************************/
Auth::routes(['verify' => true,'register' => true]);

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return redirect('/');
});

///////////////////////
//API - GET DATA ROUTES
///////////////////////
Route::get('/getUsers', 'ApiController@getUsers');
Route::get('/getNews', 'ApiController@getNews');
Route::get('/getCatalogo', 'ApiController@getCatalogo');
Route::get('/getDocs', 'ApiController@getClientDevOrders');
Route::get('/getHotNews', 'ApiController@getHotNews');
Route::get('/getNewsletter', 'ApiController@getNewsletter');
////////////////////
//PAGES - MAIN PAGES
////////////////////
Route::get('/', 'HomeController@index')->name('home');
Route::get('/cliente/{cliente_alias}', 'HomeController@infoClient');
Route::get('/cliente/{cliente_alias}/conta-corrente', 'HomeController@clientAccount')->name('conta_corrente');
Route::get('/cliente/{cliente_alias}/devolucoes', 'HomeController@listDevolucoes')->name('refund_list');
Route::get('/cliente/{cliente_alias}/devolucao/{devolucao_id}', 'HomeController@showDevolucao')->name('refund_item');
Route::get('/cliente/{cliente_alias}/utilizadores', 'HomeController@showUtilizadores')->name('showUtilizadores');
Route::get('/cliente/{cliente_alias}/encomendas', 'HomeController@listEncomendas')->name('listEncomendas');
Route::get('/cliente/{cliente_alias}/encomenda/{encomenda_id}', 'HomeController@showEncomenda');
////////////////
//DEFAULT PAGES
///////////////
Route::get('/cortes', 'HomeController@showCortes');
Route::get('/familias2', 'HomeController@showFamilies');
Route::get('/familias', 'HomeController@showFamilies');
Route::get('/novidades', 'HomeController@showNews');
Route::get('/politica-de-privacidade', 'PolicyController@readPrivacyPolitics')->name('readPrivacyPolitics');
Route::get('/termos-e-condicoes', 'PolicyController@readTermsConditions')->name('readTermsConditions');



Route::get('/gestao', 'HomeController@showGestao');
Route::get('/gerir/user/{user}/edit', 'HomeController@editUserVerification');
Route::put('/gerir/user/{user}/update', 'HomeController@updateUserVerification');
/////////////////////////////////
//EMAIL - SEND EMAILS AND CHANGES
/////////////////////////////////
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::post('/sendemail/send', 'HomeController@sendContactMail')->name('sendContactMail');
Route::post('/sendemail/sendQuestionMail', 'HomeController@sendQuestionMail')->name('sendQuestionMail');
Route::post('/sendemail/sendChangeEmailMail', 'HomeController@sendChangeEmailMail')->name('sendChangeEmailMail');
Route::post('/sendemail/sendChangePerfilMail', 'HomeController@sendChangePerfilMail')->name('sendChangePerfilMail');
Route::post('/cliente/{cliente_alias}/devolucao/{devolucao_id}', 'HomeController@sendRefund')->name('sendRefund');
Route::post('/cliente/{cliente_alias}/custom/devolucao', 'HomeController@sendCustomRefund')->name('sendCustomRefund');
Route::post('/sendemail/sendNewClientMail', 'HomeController@sendNewClientMail')->name('sendNewClientMail');
///////////////
//ADMIN ROUTES
///////////////
Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');
Route::get('/admin/users', 'AdminController@getAllClientes')->middleware('is_admin')->name('getAllClientes');
Route::get('/admin/users/criar', 'AdminController@criarGuest')->middleware('is_admin')->name('criarGuest');
Route::post('/admin/users/novo', 'AdminController@saveGuest')->middleware('is_admin')->name('saveGuest');
Route::get('/admin/users/{user}/edit',  ['as' => 'users.edit', 'uses' => 'AdminController@edit']);
Route::put('/admin/users/{user}/update', 'AdminController@update')->name('users.update');
///////////////
//OWNER ROUTES
///////////////
Route::post('/cliente/novo/utilizador/','HomeController@newUserRole')->name('newUserRole');
Route::post('ajaxRequest', 'HomeController@editUserRoles');
Route::post('newsletterRequest2', 'HomeController@sendNewsletter2');
Route::post('hotNewsRequest', 'HomeController@sendHotNews');
Route::post('deleteUserRequest', 'HomeController@deleteUserRole')->name('deleteUserRole');
Route::put('/consultPriceRoute', 'HomeController@consultPrice')->name('consultPriceModal');
Route::post('/consultPriceRoute', 'HomeController@consultPrice')->name('consultPriceModal');
///////////////
//SALES_USER ROUTES
///////////////
Route::get('/novo/cliente', 'HomeController@criarCliente')->name('criarCliente');
Route::post('/salvar/cliente', 'HomeController@saveCliente')->name('saveCliente');
///////////////
//LOGIN ACTIVITY ROUTES
///////////////
Route::group(['middleware' => ['is_admin', 'auth']], function() {
    Route::get('login-activity', 'LoginActivityController@index');
    Route::get('/login-activity/{user_id}', 'LoginActivityController@showUserActivity');
});

use App\Http\Middleware\CheckVisitedPages;

Route::group(['middleware' => [CheckVisitedPages::class]], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/cliente/{cliente_alias}', 'HomeController@infoClient');
    Route::get('/cliente/{cliente_alias}/conta-corrente', 'HomeController@clientAccount')->name('conta_corrente');
    Route::get('/cliente/{cliente_alias}/devolucoes', 'HomeController@listDevolucoes')->name('refund_list');
    Route::get('/cliente/{cliente_alias}/devolucao/{devolucao_id}', 'HomeController@showDevolucao')->name('refund_item');
    Route::get('/cliente/{cliente_alias}/encomendas', 'HomeController@listEncomendas')->name('listEncomendas');
    Route::get('/cliente/{cliente_alias}/encomenda/{encomenda_id}', 'HomeController@showEncomenda')->name('showEncomenda');
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/familias', 'HomeController@showFamilies');
    Route::get('/novidades', 'HomeController@showNews');
    //////////////////////////////////////////////////////////////////////////////////////////////////
    
});

