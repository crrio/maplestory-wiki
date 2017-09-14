@extends('layouts.app')

@section('content')

<b>Map</b>
<header class='primaryInfo'>
    <img src='https://labs.maplestory.io/api/gms/latest/map/{{$map->id}}/icon' class='icon' />
    <div class='title'>
        <span class="name">{{$map->name}}</span>
        <span class="street">{{$map->streetName}}</span>
    </div>
    @isset($map->miniMap)
    <img src='data:image/png;base64,{{$map->miniMap->canvas}}' class='minimap' />
    @endisset
</header>

<div>
    <section>
        <b class='title'>Info</b>
        <table>
        @if(!$map->isTown)
            <tr><td colspan='2'><a href='/{{$region}}/{{$version}}/map/{{$map->returnMap}}'>Returns to {{$map->returnMapName->name}} ({{$map->returnMapName->streetName}})</a></td></tr>
        @else
            <tr><td colspan='2'>Is a town</td></tr>
        @endif
        <tr><td>Mob spawn rate</td><td>{{round($map->mobRate, 2)}}</td></tr>
        @if($map->isSwim)
        <tr><td colspan='2'>You can swim here</td></tr>
        @endif
        @isset($map->linksTo)
        <tr><td colspan='2'><a href='/{{$region}}/{{$version}}/map/{{$map->linksTo}}'>Mimics another map</a></td></tr>
        @endisset
        @isset($map->minimumStarForce)
        <tr><td>Minimum star force</td><td>{{$map->minimumStarForce}}</td></tr>
        @endisset
        @isset($map->minimumArcaneForce)
        <tr><td>Minimum arcane force</td><td>{{$map->minimumArcaneForce}}</td></tr>
        @endisset
        @isset($map->minimumLevel)
        <tr><td>Minimum level</td><td>{{$map->minimumLevel}}</td></tr>
        @endisset
        <tr><td>Bounds</td><td>{{$map->vrBounds->left}},{{$map->vrBounds->top}} -&gt; {{$map->vrBounds->right}},{{$map->vrBounds->bottom}}</td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/gms/latest/map/{{$map->id}}/render'>Full map rendering</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/gms/latest/map/{{$map->id}}/render?showLife=true'>Full map rendering with life</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/gms/latest/map/{{$map->id}}/render?showPortals=true'>Full map rendering with portals</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/gms/latest/map/{{$map->id}}/render?showLife=true&showPortals=true'>Full map rendering with life and portals</a></td></tr>
        </table>
    </section>

    <section>
        <b>Has {{count($map->portals)}} portals out</b>
        @php
            $knownExits = array_filter($map->portals, function ($portal) { return isset($portal->toMapName); });
        @endphp
        <span>{{count($knownExits)}} have a known exit</span>
        <ul>
            @foreach($knownExits as $portal)
                <li><a href='/{{$region}}/{{$version}}/map/{{$portal->toMapName->id}}'>Portal to {{$portal->toMapName->name}} ({{$portal->toMapName->streetName}})</a></li>
            @endforeach
        </ul>
    </section>

    <section>
        <b>Has {{count($map->mobs)}} Mob spawn points</b>
        <ul>
            @foreach($map->mobs as $mob)
                <li><a href='/{{$region}}/{{$version}}/mob/{{$mob->id}}'>{{$mob->name}}</a> at ({{$mob->x}}, {{$mob->y}})</li>
            @endforeach
        </ul>
    </section>
    <section>
        <b>Has {{count($map->npcs)}} NPCs</b>
        <ul>
            @foreach($map->npcs as $npc)
                <li><a href='/{{$region}}/{{$version}}/npc/{{$npc->id}}'>{{$npc->name}}</a> at ({{$npc->x}}, {{$npc->y}})</li>
            @endforeach
        </ul>
    </section>
</div>


<style>
.primaryInfo .title {
    display: flex;
    flex-direction: column;
}

.primaryInfo {
    display: flex;
    align-items: center;
}

.primaryInfo img.icon {
    margin-right: 8px;
    float: left;
    flex-shrink: 0;
}

.primaryInfo img.minimap {
    float: right;
    margin: 0 0 0 auto;
}

section {
    display: inline-flex;
    flex-direction: column;
}

section {
    align-items: center;
    padding: 0 16px;
}
</style>

@endsection