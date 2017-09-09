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
            }

            .content, .content:after {
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#bbaa88+0,ccbbaa+100 */
                background: #bbaa88; /* Old browsers */
                background: -moz-linear-gradient(-45deg, #bbaa88 0%, #ccbbaa 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(-45deg, #bbaa88 0%,#ccbbaa 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(135deg, #bbaa88 0%,#ccbbaa 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bbaa88', endColorstr='#ccbbaa',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
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

            select {
                border: 0px none transparent;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                box-shadow: inset 0 0 1px rgba(85, 119, 136, 1);
                padding: 5px 25px 5px 5px;
            }

            select::-ms-expand {
                display: none;
            }

            select option{
                color: black;
            }

            select[disabled] + i, select[disabled] {
                color: #567;
                text-shadow: none;
            }

            select + i.fa {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                color: #abc;
                text-shadow: 0 -1px 1px #234;
                pointer-events: none;
                font-family: "FontAwesome";
                text-rendering: auto;
                font-style: normal;
                width: 20px;
                text-align: center;
                border-left: 1px solid #111;
                vertical-align: middle;
                display: block;
                line-height: 30px;
            }

            select:not([disabled]):hover + i, select:not([disabled]):hover, select:not([disabled]):focus + i, select:not([disabled]):focus {
                color: #FFF;
                text-shadow: 0 0 5px #777;
            }

            label {
                background: #446677;
                background: -moz-linear-gradient(top, #446677 0%, #223344 100%);
                background: -webkit-linear-gradient(top, #446677 0%,#223344 100%);
                background: linear-gradient(to bottom, #446677 0%,#223344 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#446677', endColorstr='#223344',GradientType=0 );
                padding: 0;
                height: 32px;
                border-radius: 3px;
                overflow: hidden;
                position: relative;
                border: 1px solid #111;
                box-shadow: 1px 1px 1px rgba(0,0,0,0.5);
            }

            label select {
                background: transparent;
                margin: 0;
                min-width: 100px;
                line-height: 20px;
            }

            label select:focus {
                outline: none;
            }

            label + label {
                margin-left: 8px;
            }
        </style>
        <script src="https://use.fontawesome.com/593d9f61d0.js"></script>
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
