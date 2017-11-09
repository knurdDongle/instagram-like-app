<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>

    <title>Instagram</title>

    <style>
    html {
        min-height: 100vh;
    }

    body {
        min-height: 100vh;
        background: radial-gradient(ellipse at 99% -50%, #BD47F2 10%, #0062FF 120%);
        background-repeat: no-repeat;
    }
    
    .wrapper {
        min-height: 100vh;
    }

    .wrapper .content {
        height: 100vh;  
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .footer {
        max-height: 200px;
        width: 100%;
    }

    .content-main {
        display: table;
        text-align: center;
        height: inherit;
        width: 100%;
    }

    .content-main span {
        display: table-cell;
        vertical-align: middle;
        color: #fff;
    }

    .content-main h1 {
        font-family: 'Heebo';
        font-size: 48px;
        letter-spacing: .5px;
    }

    .content-main h2 {
        font-size: 26px;
        letter-spacing: .2px;
        color: #efefef;
        font-family: 'Open Sans';
    }

    .db-1 {
        display: block;
    }

    .no-underline,
    .no-underline:hover {
        text-decoration: none;
    }

    .tt-u {
        text-transform: uppercase;
    }

    .c-btns {
        padding-top: 7rem;
    }

    .c-btn {
        padding-left: 2.25rem;
        padding-right: 2.25rem;
        padding-top: 1.75rem;
        padding-bottom: 1.75rem;
        margin-right: 1rem;
        margin-left: 1rem;
        letter-spacing: 1px;
        line-height: 1.66;
        font-size: 16px;
        border-radius: .125rem;
        font-family: 'Raleway', sans-serif;
        font-weight: 500;
    }

    .content-main a {
        color: #fff;
    }

    .bg-pink {
        background-color: #9C66FD;
        -webkit-transition: background-color .1s ease-in-out;
        transition: background-color .1s ease-in-out;
    }

    .bg-pink:hover {
        background-color: #9031B3;
    }

    .bg-blue {
        background-color: #0ABCEB;
        -webkit-transition: background-color .1s ease-in-out;
        transition: background-color .1s ease-in-out;
    }

    .bg-blue:hover {
        background-color: #0E59D1;
    }

    header {
        position: absolute;
        top: 15px;
        height: 75px;
        width: 100%;
        z-index: 100000;
        display: block;
        background: transparent;
    }

    header a {
        color: #fff;
    }

    header .svg {
        margin-top: 3px;
    }

    header.full {
        position: fixed;
        top: 0;
        background-color: #fff;
        border-bottom: 1px solid #fff;
    }

    header.full a {
        color: #000;
    }

    header .menu {
        margin-top: 13px;
    }

    header .menu a:not(:first-child) {
        margin: 5px;
        float: right !important;
        padding: 10px 15px;
        color: #fff;
        text-transform: uppercase;
        font-family: 'Open Sans';
        letter-spacing: .06em;
    }

    header.full .menu a:not(:first-child) {
        color: #000;
    }

    .btn-search-friends {
        background-color: #0ABCEB;
        color: #fff !important;
        padding-left: 2rem !important;
        padding-right: 2rem !important;
        transition: 0.2s;
    }

    .btn-search-friends:hover {
        background-color: #2286FB;
    }

    .footer-main {
        color: #fff;
        background-color: #2C3540;
    }

    .content-footer a {
        color: #fff;
    }

    .footer-main .content-footer {
        color: #fff;
        padding-left: 10rem;
        padding-right: 10rem;
        padding-top: 6rem;
        padding-bottom: 6rem;
        font-family: 'Open Sans', sans-serif;
        font-weight: 500;
    }
    
    .block {
        display: block;
    }

    a.blue-3 {
        color: #0ABCEB;
        transition: 0.2s;
    }

    a.blue-3:hover {
        color: #fff;
    }
    
    .svg {
        height: 40px;
    }

    .mb-1 {
        margin-bottom: .25rem;
    }

    .tracked {
        letter-spacing: .05em;
    }

    .content-footer .grey-5 {
        transition: 0.2s;
        color: #646E7F;
    }

    .content-footer .grey-5:hover {
        color: #798293;
    }

    .pr1 {
        padding-right: 1rem;
    }

    .pv8 {
        padding-top: 8rem;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <div class="col-xs-12 menu">
                    <a class="header-svg" href="/"><img class="svg" src="/views/templates/untitled.svg"></a>
                    <a class="btn-search-friends no-underline" href="/search"><i class="fa fa-search" aria-hidden="true"></i>
        Search friends </a>
                    <a href="/" class="menu_buttons no-underline">Contact</a>
                    <a href="/account/edit" class="menu_buttons no-underline">About Us</a>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="content-main">
                <span>
                    <h1 class="text-center">A cross-platform social network</h1>
                    <h2 class="text-center">Gramstain has everything you need to create amazing photos <span class="db-1"></span> and it comes with all the happiness of being 100% in the cloud.</h2>

                    <div class="text-center c-btns">
                        <a href="#" class="c-btn bg-pink no-underline tt-u"> <i class="fa fa-chevron-right" aria-hidden="true"></i>
Try Gramstain For Free</a>
                        <a href="/login" class="c-btn bg-blue no-underline tt-u"> <i class="fa fa-chevron-right" aria-hidden="true"></i>
Enter my account</a>
                    </div>
                </span>
            </div>
        </div>

        <div class="footer">
            <div class="footer-main">
                <div class="content-footer">
                    <div class="logo col-md-4">
                        <a href="/">
                            <img class="svg" src="/views/templates/untitled.svg">
                        </a>
                    </div>

                    <div class="latest-news col-md-4">
                        <a href="/blog" class="tracked mb-1 db-1 tt-u no-underline">On The Blog ›</a>
                        <a href="/blog/hire" class="db-1 blue-3 no-underline">We hire new appliciants</a>
                    </div>

                    <div class="ratings col-md-4">
                        <a href="/ratings" class="tracked mb-1 db-1 tt-u no-underline">Community ratings weekly ›</a>
                        <a href="/ratings/november2017" class="db-1 blue-3 no-underline">Being inclusive and animation patterns</a>
                    </div>
                </div>

                <div class="content-footer pv8">
                    <div class="col-md-4">
                        <a href="/terms" class="grey-5 pr1 no-underline">Terms</a>
                        <a href="/privacy" class="grey-5 pr1 no-underline">Privacy</a>
                    </div>

                    <div class="col-md-8 grey-5">
                        <span>© 2017 Gramstain Limited. All rights reserved. Level 1, Wall Street, Philadelphia, United States 36011.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var didScroll;
        var lastScrollTop = 0;
        var delta = 1000;
        var navbarHeight = $('header').outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();
            
            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            
            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // Scroll Down
                $('header').addClass('full');
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    $('header').removeClass('full');
                }
            }
            
            lastScrollTop = st;
        }
    </script>
</body>