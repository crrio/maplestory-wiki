<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Site') | MapleStory: Wiki</title>

        <link href="/css/app.css" rel="stylesheet" type="text/css">
        @yield('css')
        <script src='/js/app.js'></script>
    </head>
    <body>
        <header>
            <div class="container mt-0">
                <div class='navigation'>
                    <span class='header'>MapleStory: Wiki</span>
                    <ul>
                        <li><a href='/'><i class="fa fa-home"></i></a></li>
                        <li><a href='/gms/latest/items'><img src='https://labs.maplestory.io/api/gms/latest/item/4001126/iconRaw' /> Items</a></li>
                        <li class="d-none"><a href='/gms/latest/npcs'><img src='https://labs.maplestory.io/api/gms/latest/npc/9000086/icon' /> NPCs</a></li>
                    </ul>
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
