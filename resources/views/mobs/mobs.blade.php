@extends('layouts.app')

@section('title')
    Search Results
@endsection

@section('css')
<style>

ul {
    list-style: none;
    padding: 0;
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

#name {
    text-shadow:1px 1px 10px rgba(0,0,0,0.7), 1px 1px 1px rgba(0,0,0,0.7)
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
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/{{$region}}/{{$version}}/monsters/home">Monsters</a></li>
    <li class="breadcrumb-item active">Search Results</li>
</ol>
    <h2 class="mb-0">
        Monsters
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-language"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a href='/gms/latest/monsters' class="dropdown-item">English</a> 
            <a href='/kms/latest/monsters' class="dropdown-item">한국어</a> 
            <a href='/jms/latest/monsters' class='dropdown-item'>日本語</a> 
            <a href='/cms/latest/monsters' class='dropdown-item'>中文</a>
        </div>
    </h2>
    <p class="lead">
            Displaying <b>{{ $count }}</b> monsters (out of {{ number_format($mobsCount) }})
        @if(isset($minLevel) && isset($maxLevel))
            between Level <b>{{ $minLevel }}</b> and <b>{{ $maxLevel }}</b>.
        @elseif(isset($minLevel) && !isset($maxLevel))
            above Level <b>{{ $minLevel }}</b>.
        @elseif(isset($maxLevel) && !isset($minLevel))
            below Level <b>{{ $maxLevel }}</b>.
        @else
            (no level filter).
        @endif
    </p>
    <hr/>
<section>
    <div class="row mobs">
        <div class="col-md-4 size d-none"></div>
    @foreach($mobs as $mob)
        <div class="col-md-4 mb-4 mob">
            <div class="card border-dark bg-dark" style="overflow:hidden;">
                <div style="background:url('//maplestory.io/api/{{ $region }}/{{ $version }}/mob/{{ $mob->id }}/icon?resize=3') right 0px center scroll no-repeat;filter: blur(2px);position:absolute;top:0px;bottom:0px;left:0px;right:0px;z-index:0;"></div>
                <a href="/{{ $region }}/{{ $version }}/monster/{{ $mob->id }}" style="z-index:4;">
                    <div class="card-body text-white" maple-id="{{ $mob->id }}" style="z-index:2;">
                        </span><span id="name"><i class="fas fa-circle-notch fa-spin"></i></span>
                    </div>
                </a>
            </div>
        </div>
        <script>
            
        </script>
    @endforeach
    </div>
</section>
@endsection

@section('js')
<script>

var $grid = $('.mobs').imagesLoaded( function() {
    // init Isotope after all images have loaded
        var iso = new Isotope( '.mobs', {
        itemSelector: '.mob', // use a separate class for itemSelector, other than .col-
        layoutMode: 'masonry',
        masonry: {
            gutter: 0,
            columnWidth: '.size',
        }
    });
});

$('.card-body').mapleTooltip({
    region: "gms"
});

</script>
@endsection