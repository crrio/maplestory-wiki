<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NpcController extends Controller
{
    public function npc($region, $version, $id, $name = '')
    {
        $npcData = json_decode(file_get_contents(getenv('API_URL') . '/api/' . $region . '/' . $version . '/npc/'. $id));

        if($name !== str_slug($npcData->name)) {
            return redirect('/'.$region.'/'.$version.'/npc/'.$id.'/'.str_slug($npcData->name).'/');
        }
        
        return view('npcs.npc', [
            'npc' => $npcData,
            'region' => $region,
            'version' => $version
        ]);
    }
}