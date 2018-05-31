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

Route::get('/{region}/{version}/items/home', function (Request $request, $region, $version) {
    $categories = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/item/category'));

    return view('items.home', [
        'categories' => $categories,
        'region' => $region,
        'version' => $version
    ]);
})->name('items-home');

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

Route::get('/{region}/{version}/item/{id}/{name?}', function ($region, $version, $id, $name = '') {
    $itemData = @file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/item/' . $id);

    if(!$itemData) {
        return response()->view('errors.500', [], 500);
    }

    $itemData = json_decode($itemData);

    if($name !== str_slug($itemData->description->name)) {
        return redirect('/'.$region.'/'.$version.'/item/'.$id.'/'.str_slug($itemData->description->name).'/');
    }

    return view('items.item', [
        'item' => $itemData,
        'region' => $region,
        'version' => $version
    ]);
})->name('item');

Route::get('/{region}/{version}/monsters/home', function (Request $request, $region, $version) {
    return view('mobs.home', [
        'region' => $region,
        'version' => $version
    ]);
})->name('mobs-home');

Route::get('/{region}/{version}/monsters', function (Request $request, $region, $version) {
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

Route::get('/{region}/{version}/monster/{id}/{name?}', function ($region, $version, $id, $name = '') {
    $mobData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/mob/'. $id));

    if($name !== str_slug($mobData->name)) {
        return redirect('/'.$region.'/'.$version.'/monster/'.$id.'/'.str_slug($mobData->name).'/');
    }

    return view('mobs.mob', [
        'mob' => $mobData,
        'region' => $region,
        'version' => $version
    ]);
})->name('mob');

Route::get('/{region}/{version}/npc/{id}/{name?}', function ($region, $version, $id, $name = '') {
    $npcData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/npc/'. $id));

    if($name !== str_slug($npcData->name)) {
        return redirect('/'.$region.'/'.$version.'/npc/'.$id.'/'.str_slug($npcData->name).'/');
    }
    
    return view('npcs.npc', [
        'npc' => $npcData,
        'region' => $region,
        'version' => $version
    ]);
})->name('npc');

Route::get('/{region}/{version}/map/{id}/{name?}', function ($region, $version, $id, $name = '') {
    $mapData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/map/'. $id));

    if($name !== str_slug($mapData->name)) {
        return redirect('/'.$region.'/'.$version.'/map/'.$id.'/'.str_slug($mapData->name).'/');
    }

    return view('maps.map', [
        'map' => $mapData,
        'region' => $region,
        'version' => $version
    ]);
})->name('map');
