<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function map($region, $version, $id, $name = '')
    {
        $mapData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/map/'. $id));

        if($name !== str_slug($mapData->name)) {
            return redirect('/'.$region.'/'.$version.'/map/'.$id.'/'.str_slug($mapData->name).'/');
        }
    
        return view('maps.map', [
            'map' => $mapData,
            'region' => $region,
            'version' => $version
        ]);
    }
}