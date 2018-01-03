<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Auth;

//yang bisa akses cuma admin
Route::group(['middleware'=> 'checkAdmin'], function (){
    Route::get('/insert-pokemon', 'PokemonController@index_insert_pokemon'); //7. buat insert pokemon

    Route::get('/update-pokemon','PokemonController@list_update'); //list semua pokemon trus dipilih buat update pokemon

    Route::get('/update-pokemon/{id}','PokemonController@index_detail_update_pokemon'); //8. update pokemon

    Route::get('/insert-element', function () {
        return view('insert-element');
    }); //10. insert element

    Route::get('/search-user', 'UserController@index'); //12.update user

    Route::get('/update-user', 'UserController@getUpdateUser'); //Update User Detail Page.

    Route::get('/delete-user', 'UserController@getDeleteUser'); //13. delete user

    Route::get('/update-transaction', 'TransactionController@index_update'); //14. update transasction

    Route::get('/detail-transaction', function () {
        return view('detail-transaction');
    }); //liat detail dari update transaction

    Route::get('/delete-transaction', 'TransactionController@index_delete'); //15. delete transaction

    Route::get('/search-element', 'ElementController@index'); //search element untuk update

    Route::get('/delete-pokemon','PokemonController@list_delete'); //9. delete pokemon

    Route::post('/search-element', 'ElementController@redirect_to_update'); //redirect doang buat dpt id

    Route::get('/update-element/{id}', 'ElementController@index_update')->name('search-element'); //11. update element
});

//yang bisa akses cuma member
Route::group(['middleware'=> 'checkMember'], function (){
    Route::get('/profile', function () {
        return view('profile');
    });

    Route::get('/cart', 'CartController@index');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/login', 'LoginController@index');

Route::get('/register', function () {
    if(Auth::check()){
        return view('home');
    }
    return view('register');
});

Route::get('/pokemon', 'PokemonController@index');

Route::get('/pokemon-search', 'PokemonController@search');

Route::get('/pokemon-detail/{id}', 'PokemonController@index_detail_pokemon');

Route::get('/logout', 'LoginController@logout');

Route::get('/checkUser', 'LoginController@checkUser');

Route::post('/register', 'Auth\AuthController@regis');

Route::post('/login', 'LoginController@validateLogin');

Route::post('/payment', 'TransactionController@insert');

Route::post('/insert-element', 'ElementController@insert');

Route::post('/insert-pokemon', 'PokemonController@insert');

Route::post('/insert-comment', 'CommentController@insert');

Route::put('/update-element', 'ElementController@update');

Route::post('/add-cart', 'CartController@add_cart');

Route::put('/profile', 'UserController@updateProfile');

Route::put('/update-user', 'UserController@updateUser');

Route::put('/update-transaction', 'TransactionController@update_status');

Route::put('/update-pokemon','PokemonController@update');

Route::delete('/delete-cart', 'CartController@delete');

Route::delete('/delete-transaction', 'TransactionController@delete');

Route::delete('/delete-pokemon', 'PokemonController@delete');

Route::delete('/delete-user', 'UserController@deleteUser');
