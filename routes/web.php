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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{region}/{version}/items', function (Request $request, $region, $version) {
    $query = [];
    $oldData = [];

    $position = $request->query('position');
    if (isset($position)) {
        $query[] = 'startPosition=' . urlencode($position);
        $oldData['position'] = $position;
    }
    $count = $request->query('count') ?? '50';
    if (isset($count)) {
        $query[] = 'count=' . urlencode($count);
        $oldData['count'] = $count;
    }
    $overallCategory = $request->query('overallCategory');
    if (isset($overallCategory)) {
        $query[] = 'overallCategoryFilter=' . urlencode($overallCategory);
        $oldData['overallCategory'] = $overallCategory;
    }
    $category = $request->query('category');
    if (isset($category)) {
        $query[] = 'categoryFilter=' . urlencode($category);
        $oldData['category'] = $category;
    }
    $subCategory = $request->query('subCategory');
    if (isset($subCategory)) {
        $query[] = 'subCategoryFilter=' . urlencode($subCategory);
        $oldData['subCategory'] = $subCategory;
    }
    $job = $request->query('job');
    if (isset($job)) {
        $query[] = 'jobFilter=' . urlencode(strval(is_array($job) ? array_reduce($job, function ($carry, $item) {
            if (!isset($carry)) $carry = intval($item);
            else $carry |= intval($item);
            return $carry;
        }) : intval($job)));
        $oldData['job'] = is_array($job) ? $job : [$job];
    }
    $cash = $request->query('cash') == 'on';
    if (isset($cash)) {
        $query[] = 'cashFilter=' . urlencode($cash);
        $oldData['cash'] = $cash;
    }
    $minLevel = $request->query('minLevel');
    if (isset($minLevel)) {
        $query[] = 'minLevelFilter=' . urlencode($minLevel);
        $oldData['minLevel'] = $minLevel;
    }
    $maxLevel = $request->query('maxLevel');
    if (isset($maxLevel)) {
        $query[] = 'maxLevelFilter=' . urlencode($maxLevel);
        $oldData['maxLevel'] = $maxLevel;
    }
    $gender = $request->query('gender');
    if (isset($gender)) {
        $query[] = 'genderFilter=' . urlencode($gender);
        $oldData['gender'] = $gender;
    }
    $search = $request->query('search');
    if (isset($search)) {
        $query[] = 'searchFor=' . urlencode($search);
        $oldData['search'] = $search;
    }

    $queryJoined = implode('&', $query);

    $itemList = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/item?' . $queryJoined));
    $categories = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/item/category'));

    return view('items.items', [
        'items' => $itemList,
        'oldQuery' => $oldData,
        'categories' => $categories,
        'region' => $region,
        'version' => $version
    ]);
})->name('items');

Route::get('/{region}/{version}/item/{id}', function ($region, $version, $id) {
    $itemData = @file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/item/' . $id);

    if(!$itemData) {
        return response()->view('errors.500', [], 500);
    }

    $itemData = json_decode($itemData);

    return view('items.item', [
        'item' => $itemData,
        'region' => $region,
        'version' => $version
    ]);
});

Route::get('/{region}/{version}/mobs', function (Request $request, $region, $version) {
    $query = [];
    $oldData = [];

    $position = $request->query('position');
    if (isset($position)) {
        $query[] = 'startPosition=' . urlencode($position);
        $oldData['position'] = $position;
    }
    $count = $request->query('count') ?? '50';
    if (isset($count)) {
        $query[] = 'count=' . urlencode($count);
        $oldData['count'] = $count;
    }
    $minLevel = $request->query('minLevel');
    if (isset($minLevel)) {
        $query[] = 'minLevelFilter=' . urlencode($minLevel);
        $oldData['minLevel'] = $minLevel;
    }
    $maxLevel = $request->query('maxLevel');
    if (isset($maxLevel)) {
        $query[] = 'maxLevelFilter=' . urlencode($maxLevel);
        $oldData['maxLevel'] = $maxLevel;
    }
    $search = $request->query('search');
    if (isset($search)) {
        $query[] = 'searchFor=' . urlencode($search);
        $oldData['search'] = $search;
    }

    $queryJoined = implode('&', $query);

    $mobList = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/mob?' . $queryJoined));

    return view('mobs.mobs', [
        'mobs' => $mobList,
        'oldQuery' => $oldData,
        'region' => $region,
        'version' => $version
    ]);
})->name('mobs');

Route::get('/{region}/{version}/mob/{id}', function ($region, $version, $id) {
    $mobData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/mob/'. $id));
    return view('mobs.mob', [
        'mob' => $mobData,
        'region' => $region,
        'version' => $version
    ]);
});

Route::get('/{region}/{version}/npc/{id}', function ($region, $version, $id) {
    $npcData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/npc/'. $id));
    return view('npcs.npc', [
        'npc' => $npcData,
        'region' => $region,
        'version' => $version
    ]);
});

Route::get('/{region}/{version}/map/{id}', function ($region, $version, $id) {
    $mapData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/map/'. $id));
    return view('maps.map', [
        'map' => $mapData,
        'region' => $region,
        'version' => $version
    ]);
});
