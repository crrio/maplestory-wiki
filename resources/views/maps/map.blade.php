@extends('layouts.app')

@section('title')
    {{$map->name}}
@endsection

@section('css')
<style>
body {
    background: url('https://maplestory.io/api/gms/latest/map/{{ $map->id }}/render') scroll no-repeat bottom;
    background-size: cover;
}

.primaryInfo .title {
    display: flex;
    flex-direction: column;
}

.primaryInfo {
    display: flex;
    align-items: center;
}

.primaryInfo img.icon {
    margin-right: 16px;
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

.mapInfo {
    background: rgba(0,0,0,0.7);
    width: 100%;
    padding: 10px 20px;
    border-radius: 5px;
    color: #FFF;
}
</style>
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/{{$region}}/{{$version}}/maps">Maps</a></li>
    <li class="breadcrumb-item active">{{ $map->name }}</li>
</ol>
<header class="primaryInfo">
    <img src='https://maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}/icon?resize=2' class="icon d-none d-lg-block"/>
    <div class='itemName title'>
        <span class="name display-4">
            {{$map->name}}
            @if($map->isTown)
                <sup class=" d-none d-lg-inline-block"><span class="badge badge-info" style="font-size:initial;"><i class="fa fa-home"></i> Town</span></sup>
            @endif
        </span>
        <span class="street">{{$map->streetName}}</span>
    </div>
    @isset($map->miniMap)
    <img src='data:image/png;base64,{{$map->miniMap->canvas}}' class='minimap d-none d-lg-block' />
    @endisset
</header>

<div>
    @if(!$map->isTown)
        @if($map->returnMap !== $map->id)
            <a href='/{{$region}}/{{$version}}/map/{{$map->returnMap}}'>Return to {{$map->returnMapName->name}} ({{$map->returnMapName->streetName}})</a>
        @endif
    @endif
    <section class="mapInfo">
        <table>
        <tr><td>Mob spawn rate</td><td>{{round($map->mobRate, 2)}}</td></tr>
        @isset($map->isSwim)
        <tr><td colspan='2'>You can swim here</td></tr>
        @endisset
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
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}/render'>Full map rendering</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}/render?showLife=true'>Full map rendering with life</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}/render?showPortals=true'>Full map rendering with portals</a></td></tr>
        <tr><td colspan='2'><a href='https://labs.maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}/render?showLife=true&showPortals=true'>Full map rendering with life and portals</a></td></tr>
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
                <li><a href='/{{$region}}/{{$version}}/monster/{{$mob->id}}/{{ str_slug($mob->name) }}'>{{$mob->name}}</a> at ({{$mob->x}}, {{$mob->y}})</li>
            @endforeach
        </ul>
    </section>
    <section>
        <b>Has {{count($map->npcs)}} NPCs</b>
        <ul>
            @foreach($map->npcs as $npc)
                <li><a href='/{{$region}}/{{$version}}/npc/{{$npc->id}}/{{ str_slug($npc->name) }}'>{{$npc->name}}</a> at ({{$npc->x}}, {{$npc->y}})</li>
            @endforeach
        </ul>
    </section>
    <br/>
    <a class="btn btn-soft btn-sm mt-3" href="//maplestory.io/api/{{$region}}/{{$version}}/map/{{$map->id}}" target="_blank">
        <i class="fal fa-code"></i> View API Request
    </a>
</div>
@endsection