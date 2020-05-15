<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/select2-bootstrap.css">
    <link href="css/font-awesome-5-all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    @yield("style")
    <title>Laravel</title>
</head>

<body class="pb-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
{{--        <a class="navbar-brand" href="#">PFT</a>--}}
        <a class="navbar-brand" href="#">
            <i class="fas fa-parking mr-2 category-icon text-success"></i> PFT
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="#">Overview</a>
                <a class="nav-item nav-link {{Route::currentRouteName() == 'transactions' ? 'active' : ''}}" href="{{route('transactions')}}">Transactions</a>

                <a class="nav-item nav-link {{Route::currentRouteName() == 'accounts' ? 'active' : ''}}" href="{{route('accounts')}}">Accounts</a>
                <a class="nav-item nav-link {{Route::currentRouteName() == 'categories' ? 'active' : ''}}" href="{{route('categories')}}">Categories</a>
                <div class="nav-item dropdown {{in_array(Route::currentRouteName(), ['reports', 'about-us']) ? 'active' : ''}}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('reports')}}">Reports</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#contact-us-modal">Contact Us</a>
                        <a class="dropdown-item" href="#">About Us</a>
                    </div>
                </div>
                <div class="dropdown ml-2">
                    <span class="round-user-icon-container border border-success rounded-circle text-success content-box" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
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

@yield("content")

    <footer class="footer">
        <div class="container text-center">
            <span class="text-muted">&copy; {{date("Y")}} Lubov Langleben</span>
        </div>
    </footer>


<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/select2.full.min.js"></script>
<script defer src="js/font-awesome-5-all.min.js"></script> <!--load all styles -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
@yield("scripts")
@include("modals.contact-us")

</body>
</html>


