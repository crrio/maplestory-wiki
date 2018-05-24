<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Site') | MapleStory: Wiki</title>
        <meta name='keywords' content="maplestory, maplestory wiki, maple wiki, maplestory knowledge base, gms, maplestory classes, maplestory items" />
        <meta name='description' content="@yield('desc', 'The complete knowledge base and database for Maplestory.')" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="@yield('title', 'Site') | MapleStory: Wiki" />
        <meta property="og:description" content="@yield('desc', 'The complete knowledge base and database for Maplestory.')" />
        <meta property="og:image" content="@yield('image', 'http://maplestory.io/api/gms/latest/mob/100006/icon?resize=3')" />
        <link rel="stylesheet" href="/css/app.css">
        <meta name="twitter:site" content="@crrio">
        <meta name="twitter:title" content="@yield('title', '') | MapleStory: Wiki">
        <meta name="twitter:description" content="The complete knowledge base and database for Maplestory.">

        <link href="/css/app.css" rel="stylesheet" type="text/css">

        @yield('css')
        <script src='/js/app.js'></script>
    </head>
    @php
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
        
        $bg = $bgs[array_rand($bgs)];
        $start = $locations[array_rand($locations)];
    @endphp
    <body>
        <header>
            <div class="container mt-0 fixed-top h">
                <nav class="navbar navbar-expand-md bg-light justify-content-between" style="background:url('{{ $bg }}') scroll {{ $start }} no-repeat !important; background-size:cover !important;">
                    <a class="navbar-brand" href="/"><b>MapleStory:</b> Wiki</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fa fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                      <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href='/gms/latest/items'>Items</a>
                        <a class="nav-item nav-link" href='/gms/latest/mobs'>Mobs</a>
                        <a class="nav-item nav-link" data-toggle="collapse" href="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><i class="fa fa-search"></i></a>
                      </div>
                    </div>
                </nav>
                <div class="collapse justify-content-between" id="searchBox">
                    
                    @if (Route::currentRouteName() == 'items')  
                    <form method='get' action='/{{$region}}/{{$version}}/items'>
                        <input class="d-inline-block p-1 m-2 s-box" type='search' name='search' value='{{$oldQuery['search'] ?? ''}}'/ placeholder="Search for items..">
                    @elseif (Route::currentRouteName() == 'mobs')
                    <form method='get' action='/{{$region}}/{{$version}}/mobs'>
                        <input class="d-inline-block p-1 m-2 s-box" type='search' name='search' value='{{$oldQuery['search'] ?? ''}}'/ placeholder="Search for mobs..">
                    @else
                    {{-- Since we only support items currently, only display the items search box. --}}
                    <form method='get' action='/gms/latest/items'>
                        <input class="d-inline-block p-1 m-2 s-box" type="search" placeholder="Search for items.." aria-label="Search" name='search'>
                    @endif
                        @yield('searchoptions')
                    </form>
                </div>
            </div>
        </header>
        <main>
            <div class='container'>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- maplestory.wiki -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="{{getenv('AD_CLIENT')}}"
                     data-ad-slot="{{getenv('AD_SLOT')}}"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <div class='content'>
                    @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p class="mb-2">
                All assets and resources regarding MapleStory thereof are the sole property of <a href="//nexon.net">Nexon</a> and applies to their Terms of Use.<br/>
            </p>
            <p class="mb-0">
                <a href='//crr.io' class='btn'>A Crrio Project</a>
                <a href='https://github.com/crrio/maplestory-wiki' class='btn'><i class="fab fa-github"></i> Open Source on GitHub</a>
                <a href='https://discord.gg/WhmT8dU' class='btn'><i class="fab fa-discord"></i> Join our Discord</a>
            </p>
        </footer>
        @yield('js')
    </body>
</html>
