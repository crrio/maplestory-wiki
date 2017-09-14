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
                color: #333;
                font-family: 'Raleway', sans-serif;
                font-weight: 400;
                padding: 0;
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

            .content {
                display: flex;
                flex-direction: column;
                max-width: 1084px;
                margin: 0 auto;
                position: relative;
                box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
            }

            .content, .content:after {
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#bbaa88+0,ccbbaa+100 */
                background: #bbaa88; /* Old browsers */
                background: -moz-linear-gradient(-45deg, #bbaa88 0%, #ccbbaa 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(-45deg, #bbaa88 0%,#ccbbaa 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(135deg, #bbaa88 0%,#ccbbaa 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bbaa88', endColorstr='#ccbbaa',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
                padding: 30px;
                border-radius: 15px;
                overflow: hidden;
            }

            .content:after {
                position: absolute;
                top: 8px;
                bottom: 8px;
                left: 8px;
                right: 8px;
                content: ' ';
                display: block;
                z-index: 0;
                box-shadow: 0 0 2px rgba(0, 0, 0, 1);
                border-radius: 15px;
            }

            .content > * {
                z-index: 3;
                position: relative;
            }

            b {
                text-shadow: 0 0 10px rgba(0, 0, 0, 1);
                color: #ffffff;
                font-size: 24px;
                text-align: center;
            }

            b.title {
                width: 100%;
                display: block;
            }

            .content:before {
                content: ' ';
                display: block;
                position: absolute;
                top: 0;
                width: 400px;
                background: rgba(0,0,0, 0.05);
                height: 150px;
                left: 50%;
                transform: translateX(-50%) translateY(-70%);
                z-index: 2;
                border-radius: 100%;
            }

            .navigation ul {
                padding: 0;
                margin: 0;
                list-style: none;
                box-shadow: inset 0 0 4px rgba(60, 60, 60, 0.8);
                border-radius: 6px;
                background: rgba(60, 60, 60, 0.2);
                min-height: 68px;
                overflow: hidden;
            }

            .navigation {
                margin: 0 auto;
                border-bottom-left-radius: 6px;
                position: relative;
                box-shadow: inset 0 0 8px rgba(255, 255, 255, 0.7), 0 0 8px black;
                border-bottom-right-radius: 6px;
                padding: 64px 8px 8px 8px;
                background: #bbaa88; /* Old browsers */
                background: -moz-linear-gradient(-45deg, #bbaa88 0%, #ccbbaa 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(-45deg, #bbaa88 0%,#ccbbaa 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(135deg, #bbaa88 0%,#ccbbaa 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bbaa88', endColorstr='#ccbbaa',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }

            .navigation:before {
                content: ' ';
                position: absolute;
                background: -moz-linear-gradient(top, rgba(255, 255, 255, 0) 0%, #e2e1e0 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 0%, #e2e1e0 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to top, rgba(255, 255, 255, 0) 0%, #e2e1e0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(255, 255, 255, 0)', endColorstr='#e2e1e0',GradientType=0 ); /* IE6-9 */
                height: 64px;
                top: 0px;
                left: -6px;
                right: -6px;
            }

            .navigation li a {
                min-height: 32px;
                display: flex;
                border-radius: 6px;
                box-shadow: 0 0 2px black, inset 0 1px 1px rgba(170, 170, 170, 1), inset 0 -1px 1px rgba(119, 119, 119, 1);
                background: rgba(136, 136, 136, 1);
                min-width: 128px;
                text-align: center;
                color: rgba(255, 255, 255, 0.9);
                text-shadow: 0 0 1px rgba(255, 255, 255, 0.3);
                font-size: 16px;
                line-height: 32px;
                max-width: 128px;
                max-height: 32px;
                justify-content: center;
                align-items: center;
            }

            .navigation li a:hover, .navigation li a.selected {
                background: rgba(51, 153, 204, 1);
                background: linear-gradient(to top, rgba(51, 153, 204, 1) 0%, rgba(51, 187, 238, 1) 100%);
            }

            .navigation li {
                display: inline-block;
                float: left;
                margin: 1px;
                min-height: 32px;
            }

            @media (min-device-width: 1280px) {
                .navigation{
                    max-width: 1056px;
                }
            }

            @media (min-device-width: 1024px) and (max-device-width: 1280px) {
                .navigation {
                    max-width: 926px;
                }
            }

            @media (min-device-width: 896px) and (max-device-width: 1023px) {
                .navigation {
                    max-width: 796px;
                }
            }

            @media (min-device-width: 768px) and (max-device-width: 911px) {
                .navigation {
                    max-width: 666px;
                }
            }

            @media (min-device-width: 640px) and (max-device-width: 783px) {
                .navigation {
                    max-width: 536px;
                }
            }

            @media (min-device-width: 512px) and (max-device-width: 655px) {
                .navigation {
                    max-width: 406px;
                }
            }

            @media (min-device-width: 300px) and (max-device-width: 527px) {
                .navigation {
                    max-width: 276px;
                }
            }

            @media (max-device-width: 300px) {
                .navigation {
                    max-width: 146px;
                }
            }

            .navigation img {
                flex-shrink: 0;
            }

            .container {
                margin: 16px auto;
                max-width: 1084px;
            }

            .navigation span.header:after {
                background: rgb(255, 187, 0); /* Old browsers */
                background: -moz-linear-gradient(-45deg, rgba(255, 238, 68, 1) 0%, rgb(255, 187, 0) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(rgba(255, 238, 68, 1), rgb(255, 187, 0));
                background: linear-gradient(135deg, rgba(255, 238, 68, 1) 0%, rgb(255, 187, 0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(255, 238, 68, 1)', endColorstr='rgb(255, 187, 0)',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                font-weight: 600;
                color: white;
                text-shadow: none;
                position: absolute;
                left: 0px;
                right: 0px;
                content: 'NAV';
                font-size: 18px;
                text-align: center;
            }

            .navigation span.header {
                position: absolute;
                text-shadow: 0 0 1px black;
                font-weight: 600;
                top: 32px;
                color: white;
                font-size: 18px;
                left: 8px;
                right: 8px;
                padding-bottom: 2px;
                border-bottom: 1px solid #aaa;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <div class='navigation'>
            <span class='header'>NAV</span>
            <ul>
                <li><a href='/gms/latest/item'><img src='https://labs.maplestory.io/api/gms/latest/item/1302000/iconRaw' />Item</a></li>
                <li><a href='/kms/latest/item'><img src='https://labs.maplestory.io/api/gms/latest/item/1302000/iconRaw' />아이템</a></li>
            </ul>
        </div>
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
