<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MapleStory: Wiki</title>

        <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #e2e1e0;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 400;
                height: 100vh;
            }

            html {
                margin: 0;
            }

            * {
                box-sizing: border-box;
            }

            a {
                text-decoration: none;
                color: #007fff;
                text-shadow: 0px 0px 0px #007fff;
                font-weight: 400;
            }

            span {
                font-weight: 100;
                text-shadow: 0px 0px 0px #000;
            }

            .content {
                display: flex;
                flex-direction: column;
                max-width: 800px;
                margin: 0 auto;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            section {
                margin: 16px 0 8px 0;
            }

            header {
                margin: 0 0 8px 0;
            }

            section .title, header .title {
                font-size: 24px;
            }

            .disclaimer {
                text-align: center;
                margin: 16px 0 32px 0;
            }

            .bold {
                font-weight: 600;
                text-shadow: none;
            }

            .desc-b {
                color: #5699af;
            }
            .desc-c {
                color: darkorange;
            }
            .desc-d {
                color: purple;
            }
            .desc-e {
                font-weight: bold;
            }
            .desc-r {
                color: red; /* Used in quest dialogs and some items with warnings / dangerous */
            }
            .desc-g {
                color: green;
            }
            .desc-k {
                color: black; /* Nexon'd tag, but still need to add it so it's replaced. Used in some custom dialogs */
            }

            .container {
                min-height: 100px;
                margin-bottom: 16px;
            }

            .text-success {
                color: #27c24c;
            }

            .text-danger {
                color: #f05050;
            }
        </style>
    </head>
    <body>
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
        </div>
        <div class='content'>
            @yield('content')
        </div>
        <p class='disclaimer'>
            All images and content relating to MapleStory are copyright Nexon, we provide this site as an educational tool for MapleStory's content.
        </p>
    </body>
</html>
