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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item/{id}', function ($id) {
    $itemData = json_decode(file_get_contents('http://localhost:5000/api/gms/latest/item/' . $id));
    return view('item', ['item' => $itemData]);
});