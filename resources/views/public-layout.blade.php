<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="/css/font-awesome-5-all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <title>PFT @yield('title')</title>
</head>
<body class="mb-0">
    <header class="header">
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand" href="/">
                <i class="fas fa-chart-line mr-2 category-icon text-success"></i>PFT
            </a>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                @guest
                    <form class="form-inline ml-auto">
                        <button class="invisible scroll-item js-contact-us-scroll-button"
                                data-scroll-nav="2"></button>
                        <button class="btn btn-outline-light my-2 my-sm-0 mr-sm-2"
                                type="button"
                                data-toggle="modal"
                                data-target="#sign-in-modal">
                            Sign in
                        </button>
                        <button class="btn btn-outline-light my-2 my-sm-0"
                                type="button"
                                data-toggle="modal"
                                data-target="#sign-up-modal">
                            Sign up
                        </button>
                    </form>
                @endguest
            </div>
        </nav>
    </header>
    @yield('content')

    @include("modals.signIn")
    @include("modals.signUp")

    <footer class="footer z-index-2">
        <div class="container text-center">
            <span class="text-muted">&copy; 2020-{{date("Y")}} PFT Lubov Langleben</span>
        </div>
    </footer>

    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script defer src="/js/font-awesome-5-all.min.js"></script> <!--load all styles -->
    @yield('script')
    <script>
        $('.js-show-hidden').on('mousedown', function(){
            if($(this).siblings('input').attr('type') === 'text') {
                $(this).find('svg').removeClass('fa-eye').addClass('fa-eye-slash');
                $(this).siblings('input').attr('type', 'password');
            }
            else {
                $(this).find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
                $(this).siblings('input').attr('type', 'text');
            }
        });
    </script>
</body>
</html>
