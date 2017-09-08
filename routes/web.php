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
    $itemData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/item/' . $id));
    return view('item', ['item' => $itemData]);
});

Route::get('/mob/{id}', function ($id) {
    $mobData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/mob/'. $id));
    return view('mob', ['mob' => $mobData]);
});

Route::get('/npc/{id}', function ($id) {
    $npcData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/npc/'. $id));
    return view('npc', ['npc' => $npcData]);
});

Route::get('/map/{id}', function ($id) {
    $mapData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/map/'. $id));
    return view('map', ['map' => $mapData]);
});