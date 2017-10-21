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

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    if(Auth::check()){
        return view('home');
    }
    return view('login');
});

Route::get('/register', function () {
    if(Auth::check()){
        return view('home');
    }
    return view('register');
});

Route::get('/profile', function () {
    if(Auth::User()->role == 'member'){
        return view('profile');
    }
    return view('home');
});

Route::get('/pokemon', 'PokemonController@index');

Route::get('/pokemon-search', 'PokemonController@search');

Route::get('/pokemon-detail/{id}', 'PokemonController@index_detail_pokemon');

Route::get('/insert-pokemon', 'PokemonController@index_insert_pokemon');

Route::get('/update-pokemon', function () {
    if(Auth::check()){
        if(Auth::User()->role =='admin')
            return view('update-pokemon');
    }
    return view('home');
});

Route::get('/insert-element', function () {
    if(Auth::check()){
        if(Auth::User()->role =='admin')
            return view('insert-element');
    }
    return view('home');
});

Route::get('/update-element', function () {
    if(Auth::check()){
        if(Auth::User()->role =='admin')
            return view('update-element');
    }
    return view('home');
});

Route::get('/search-user', 'UserController@index');

Route::get('/update-user', 'UserController@getUpdateUser');

Route::get('/delete-user', 'UserController@getDeleteUser');

Route::get('/cart', 'CartController@index');

Route::post('/payment', 'TransactionController@insert');

Route::get('/update-transaction', 'TransactionController@index_update');

Route::get('/detail-transaction', function () {
    if(Auth::check()){
        if(Auth::User()->role =='admin')
            return view('detail-transaction');
    }
    return view('home');
});

Route::get('/delete-transaction', 'TransactionController@index_delete');

Route::get('/logout', function (){
    Auth::logout();

    return view('/home');
});

Route::get('/checkUser', 'LoginController@checkUser');

Route::get('/search-element', 'ElementController@index');

Route::get('/update-element/{$id}', function () {
    return view('update-element');
});

Route::post('/register', 'Auth\AuthController@regis');

Route::post('/login', 'LoginController@validateLogin');

Route::post('/profile', 'UserController@updateProfile');

Route::post('/insert-element', 'ElementController@insert');

Route::post('/update-element', 'ElementController@update');

Route::post('/insert-pokemon', 'PokemonController@insert');

Route::post('/insert-comment', 'CommentController@insert');

Route::post('/update-user', 'UserController@updateUser');

Route::delete('/delete-user', 'UserController@deleteUser');

Route::post('/add-cart', 'CartController@add_cart');

Route::delete('/delete-cart', 'CartController@delete');

Route::put('/update-transaction', 'TransactionController@update_status');

Route::delete('/delete-transaction', 'TransactionController@delete');