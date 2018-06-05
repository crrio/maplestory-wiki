<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function home(Request $request, $region, $version)
    {
        return view('mobs.home', [
            'region' => $region,
            'version' => $version
        ]);  
    }

    public function monsters(Request $request, $region, $version)
    {
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
    }

    public function monster($region, $version, $id, $name = '')
    {
        $mobData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/mob/'. $id));

        if($name !== str_slug($mobData->name)) {
            return redirect('/'.$region.'/'.$version.'/monster/'.$id.'/'.str_slug($mobData->name).'/');
        }
    
        return view('mobs.mob', [
            'mob' => $mobData,
            'region' => $region,
            'version' => $version
        ]);
    }
}