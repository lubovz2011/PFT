<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/select2.min.css">
        <link rel="stylesheet" href="/css/select2-bootstrap.css">
        <link href="/css/font-awesome-5-all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/styles.css">
        @yield("style")
        <title>PFT - @yield('title')</title>
    </head>

    <body class="pb-4">
        <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line mr-2 category-icon text-success"></i>PFT
            </a>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link {{Route::currentRouteName() == 'reports' ? 'active' : ''}}"
                       href="{{route('reports')}}">
                        Dashboard
                    </a>
                    <a class="nav-item nav-link {{Route::currentRouteName() == 'transactions' ? 'active' : ''}}"
                       href="{{route('transactions')}}">
                        Transactions
                    </a>
                    <a class="nav-item nav-link {{Route::currentRouteName() == 'accounts' ? 'active' : ''}}"
                       href="{{route('accounts')}}">
                        Accounts
                    </a>
                    <a class="nav-item nav-link {{Route::currentRouteName() == 'categories' ? 'active' : ''}}"
                       href="{{route('categories')}}">
                        Categories
                    </a>
                    <div class="nav-item dropdown {{Route::currentRouteName() == 'about-us' ? 'active' : ''}}">
                        <a class="nav-link dropdown-toggle"
                           href="#" id="navbarDropdown"
                           role="button"
                           data-toggle="dropdown">
                            More
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="#"
                               data-toggle="modal"
                               data-target="#contact-us-modal">
                                Contact Us
                            </a>
                            <a class="dropdown-item {{Route::currentRouteName() == 'about-us' ? 'active' : ''}}"
                               href="{{route('about-us')}}">
                                About Us
                            </a>
                        </div>
                    </div>
                    <div class="dropdown ml-2">
                        <span class="round-user-icon-container border border-success rounded-circle text-success content-box"
                              id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right" >
                            <a class="dropdown-item" href="{{route('settings')}}">Settings</a>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <button onclick="topFunction()" id="btnToTop" class="btn-to-top btn js-show-hide-btn" type="button">
            <i class="fas fa-chevron-up"></i>
        </button>


    @yield("content")
        <div class="loader-wrapper invisible">
            <div class="loader">
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__ball"></div>
            </div>
        </div>



        <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">&copy; 2020-{{date("Y")}} PFT Lubov Langleben</span>
            </div>
        </footer>

        @include("modals.contact-us")

    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/select2.full.min.js"></script>
    <script defer src="/js/font-awesome-5-all.min.js"></script> <!--load all styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            function number_format(number, decimals, dec_point, thousands_point)
            {
                if (number == null || !isFinite(number)) {
                    throw new TypeError("number is not valid");
                }
                if (!decimals) {
                    var len = number.toString().split('.').length;
                    decimals = len > 1 ? len : 0;
                }
                if (!dec_point) {
                    dec_point = '.';
                }
                if (!thousands_point) {
                    thousands_point = ',';
                }
                number = parseFloat(number).toFixed(decimals);
                number = number.replace(".", dec_point);

                var splitNum = number.split(dec_point);
                splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
                number = splitNum.join(dec_point);

                return number;
            }

            function loaderStart(){
                $('.loader-wrapper').removeClass('invisible');
            }
            function loaderStop(){
                $('.loader-wrapper').addClass('invisible');
            }

        /* -------------open contact-us modal in case of some error or message was successfully send-------------------- */
            @if(session('send-status') || session('send-status-error') || $errors->hasAny(['contact-email', 'contact-subject', 'contact-message']))
                $('#contact-us-modal').modal();
            @endif

        /* -------------change eye with mouse clicking on it to show/hide data-------------------- */
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

            /* -------------show/hide btn to top when the user scrolls down-------------------- */
            var btnToTop = document.getElementById("btnToTop");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
                {
                    btnToTop.style.display = "block";
                }
                else {
                    btnToTop.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                window.scrollTo({top: 0, behavior: 'smooth'});
            }

        </script>
        @yield("scripts")
    </body>
</html>


