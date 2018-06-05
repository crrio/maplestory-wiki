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

use Illuminate\Http\Request;

Route::get('/', 'Controller@welcome')->name('welcome');

// Items
Route::get('/{region}/{version}/items/home', 'ItemController@home')->name('items-home');
Route::get('/{region}/{version}/items', 'ItemController@items')->name('items');
Route::get('/{region}/{version}/item/{id}/{name?}', 'ItemController@item')->name('item');

// Monsters
Route::get('/{region}/{version}/monsters/home', 'MonsterController@home')->name('monsters-home');
Route::get('/{region}/{version}/monsters', 'MonsterController@monsters')->name('monsters');
Route::get('/{region}/{version}/monster/{id}/{name?}', 'MonsterController@monster')->name('monster');

// Npcs
Route::get('/{region}/{version}/npc/{id}/{name?}', 'NpcController@npc')->name('npc');

// Maps
Route::get('/{region}/{version}/map/{id}/{name?}', 'MapController@map')->name('map');
