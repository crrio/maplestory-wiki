@extends('layouts.app')

@section('title')
    Monsters
@endsection

@section('css')
<style>

ul {
    list-style: none;
    padding: 0;
}

li {
    min-height: 40px;
}

li span {
    display: inline-flex;
    align-items: center;
    font-weight: 400;
}

li img {
    flex-shrink: 0;
    margin-right: 8px;
}

form label {
    display: inline-flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    padding-left: 10px;
}

input[type="number"] {
    max-width: 150px;
}

input[type="number"], input[type="text"], select {
    background: rgba(0, 0, 0, 0.4);
    border: 0px none transparent;
    box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.8);
    border-radius: 4px;
    /* background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.4), 0%, rgba(0, 0, 0, 0.2) 100%);
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(0, 0, 0, 0.4)', endColorstr='rgba(0, 0, 0, 0.2)',GradientType=0 ); */
    color: rgba(255, 255, 255, 0.7);
    text-shadow: 0 0 2px rgba(255, 255, 255, 0.2);

    display: inline-block;
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
}
.search-box {
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
    display: inline-block;
}

input[type="reset"], input[type="submit"] {
    margin-left: 8px;
}

.search {
    width: 100px;
}

.cog {
    position: relative;
    top: -48px;
}

.mob-icon {
    max-width: 200px;
    margin-right: 10px;
}
</style>
@endsection

@section('searchoptions')
<a class="btn btn-primary btn-sm float-right mt-2 mr-2 cog" data-toggle="collapse" href="#searchControls" role="button" aria-expanded="false" aria-controls="searchControls">
    <i class="fa fa-cog"></i>
</a>
<div class="collapse pl-2 pr-2 pb-2 pt-0" id="searchControls">
    <select name='count' class="count ml-2">
            <option value='10' {{ (($oldQuery['count'] ?? 0) == 10) ? 'selected' : '' }}>10 Mobs</option>
            <option value='25' {{ (($oldQuery['count'] ?? 0) == 25) ? 'selected' : '' }}>25 Mobs</option>
            <option value='50' {{ (($oldQuery['count'] ?? 0) == 50) ? 'selected' : '' }}>50 Mobs</option>
            <option value='100' {{ (($oldQuery['count'] ?? 0) == 100) ? 'selected' : '' }}>100 Mobs</option>
            <option value='250' {{ (($oldQuery['count'] ?? 0) == 250) ? 'selected' : '' }}>250 Mobs</option>
    </select>
    <label id='minLevel' for="minLevel">
        <span>Min Level</span>
    </label>
    <input type='number' name='minLevel' value='{{$oldQuery['minLevel'] ?? ''}}' min="1" max="250" />
    
    <label id='maxLevel'>
        <span>Max Level</span>
    </label>
    <input type='number' name='maxLevel' value='{{$oldQuery['maxLevel'] ?? ''}}' min="1" max="250" />
    <br/>
    <input type='reset' value='Reset' class="btn btn-danger btn-sm mt-2"/>
    <input type='submit' value='Apply' class="btn btn-success btn-sm mt-2"/>
</div>
@endsection

@section('content')
<form method='get' action='/{{$region}}/{{$version}}/monsters'>
    <div class="justify-content-between">
        <h2 class="mb-0">
            Monsters
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-language"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href='/gms/latest/monsters/home' class="dropdown-item">English</a> 
                <a href='/kms/latest/monsters/home' class="dropdown-item">한국어</a> 
                <a href='/jms/latest/monsters/home' class='dropdown-item'>日本語</a> 
                <a href='/cms/latest/monsters/home' class='dropdown-item'>中文</a>
            </div>
        </h2>
        <p class="lead">In the Maple World, there are dungeons to explore and new monsters to discover. View detailed statistics about every monster in addition to bosses via our wiki.</p>
    </div>
</form>

<section>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white border-primary guide-card" style="background:url('https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_lith_a.dds') scroll top no-repeat !important; background-size:cover !important;">
                <div class="card-body" style="z-index:2;">
                    <h5 class="card-title"><i class="fa fa-star text-warning"></i> Recommended Training</h5>
                    <p class="card-text">A collection of monsters and training maps recommended for level progression for all servers.</p>
                    <a href="#" class="btn btn-sm btn-primary text-white disabled">View Guide</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card guide-card text-white border-success" style="background:url('https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_ellinia_a.dds') scroll top no-repeat !important; background-size:cover !important;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-star text-warning"></i> Recommended for Equips</h5>
                    <p class="card-text">A collection of monsters recommended for obtaining level-specific equips from levels 10 to 140.</p>
                    <a href="#" class="btn btn-sm btn-success text-white disabled">View Guide</a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group mt-4">
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=1&maxLevel=10" class="list-group-item list-group-item-action">
            Level 1 - 10
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=11&maxLevel=20" class="list-group-item list-group-item-action">
            Level 11 - 20
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=21&maxLevel=30" class="list-group-item list-group-item-action">
            Level 21 - 30
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=31&maxLevel=40" class="list-group-item list-group-item-action">
            Level 31 - 40
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=41&maxLevel=50" class="list-group-item list-group-item-action">
            Level 41 - 50
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=51&maxLevel=70" class="list-group-item list-group-item-action">
            Level 51 - 70
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=71&maxLevel=99" class="list-group-item list-group-item-action">
            Level 71 - 99
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=100&maxLevel=120" class="list-group-item list-group-item-action">
            Level 100 - 120
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=121&maxLevel=140" class="list-group-item list-group-item-action">
            Level 121 - 140
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=141&maxLevel=160" class="list-group-item list-group-item-action">
            Level 141 - 160
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=161&maxLevel=199" class="list-group-item list-group-item-action">
            Level 161 - 199
        </a>
        <a href="/{{$region}}/{{$version}}/monsters?search=&count=100&minLevel=200" class="list-group-item list-group-item-action">
            Level 200+
        </a>
        <a href="/{{$region}}/{{$version}}/monsters/" class="list-group-item list-group-item-action">
            <img src="https://maplestory.io/api/gms/latest/mob/100100/icon" class="mob-icon">
            View All
        </a>
    </div>
</section>
@endsection

@section('js')
<script>
/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

 ;(function($) {

  $.fn.unveil = function(threshold, callback) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;

    this.one("unveil", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;

  };

})(window.jQuery || window.Zepto);

$(document).ready(function() {
  $("img").unveil();
});

</script>
@endsection