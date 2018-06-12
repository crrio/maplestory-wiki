<?php

namespace Libraries;

use App\Contrib\Article;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\Contrib\ContribController;
use App\Invite;
use App\Log;
use App\Topic;
use App\User;
use Carbon\Carbon;
use File;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MenaraSolutions\Geographer\City;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\State;
use Route;

class Crrio
{
    public static function bg() {
        $bgs = array(
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_lith_a.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_lith_b.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_ellinia_a.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_henesys_a.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_iceage_a.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_perion_b.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_tria.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_pirates_a.dds',
            'https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_pirates_b.dds'
        );
        $locations = array('center', 'top', 'bottom');
        
        $bg['bg'] = $bgs[array_rand($bgs)];
        $bg['start'] = $locations[array_rand($locations)];
        
        return 'background:url("'.$bg['bg'].'") scroll '.$bg['start'].' no-repeat !important; background-size:cover !important;';
    }

    public static function smart($id) {
        return('<a class="smart" maple-id="'.$id.'"></a>');
    }
}
?>