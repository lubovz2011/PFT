<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/font-awesome-5-all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <title>PFT</title>
    </head>
    <body>
        <header class="header">
            <nav class="navbar navbar-expand-sm navbar-light">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-chart-line mr-2 category-icon text-success"></i>PFT
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <form class="form-inline ml-auto">
                        <button class="btn btn-outline-light my-2 my-sm-0 mr-sm-2" type="button" data-toggle="modal" data-target="#sign-in-modal">Sign in</button>
                        <button class="btn btn-outline-light my-2 my-sm-0" type="button" data-toggle="modal" data-target="#sign-up-modal">Sign up</button>
                    </form>
                </div>
            </nav>
        </header>


        <main role="main">
            <div class="d-flex">
                <div class="container-welcome-image position-relative">
                    <div class="overlay opacity-6"></div>
                    <div class="d-flex h-100 flex-column justify-content-center align-items-center">
                        <div class="col-xs col-md-4 z-index-2">
                            <div class="text-white text-center">
                                <h1>PFT</h1>
                                <h3>Personal Finance Tracker</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="about-us pt-100 pb-50" data-scroll-index="1">
                <div class="container">
                    <!--==== Section Heading Text =====-->
                    <div class="section-header">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="heading-2">
                                    <h2 class="text-grediant d-inline-block">About Us</h2>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <p>
                                    Welcome to Personal Finance Tracker.
                                </p>
                                <p class="subtitle">
                                    Can't get your finances in order? Don't know where your money is going? You came to the right place!<br>
                                    PFT it's a free website, designed to help you organize and concentrate your cash flows in one place and in a convenient way.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="400">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="fas fa-chart-bar fa-lg welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Get an overview</h6>
                                    <p>
                                        You can see overview about your total incomes and expenses in one place.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="600">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="far fa-credit-card welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Digital Accounts Synchronization</h6>
                                    <p>
                                        Connect your bank accounts and all your transactions will get automatically imported to PFT.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="fas fa-icons welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Categories</h6>
                                    <p>
                                        Manage your daily expenses and income as you wish.
                                        You can create as many categories as you want and edit them.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="400">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="fas fa-shekel-sign welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Multiple currencies</h6>
                                    <p>
                                        PFT support multiple currencies so you can create accounts in different currencies.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="600">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="fas fa-envelope-open-text welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Monthly Report</h6>
                                    <p>
                                        Receive a monthly email report that give you overview of your spending, income by dates or categories.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--==== Feature Box =====-->
                        <div class="col-md-6 col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                            <div class="feature-card">
                                <div class="icon-img">
                                    <i class="far fa-thumbs-up welcome-icon text-success"></i>
                                </div>
                                <div class="feature-body">
                                    <h6>Free and without commercials</h6>
                                    <p>
                                        All services on the site are free. Without advertisements and ads.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include("modals.signIn")
        @include("modals.signUp")

        <footer class="footer">
            <div class="container text-center">
                <span class="text-muted">&copy; {{date("Y")}} Lubov Langleben</span>
            </div>
        </footer>

        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script defer src="js/font-awesome-5-all.min.js"></script> <!--load all styles -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            $(document).ready(function(){
                AOS.init();
                let signInError = {{($errors->has('login') || $errors->has('password')) ? 1 : 0}};
                let signUpError = {{($errors->has('signup_login') || $errors->has('signup_password')) ? 1 : 0}};

                if(signInError){
                    $('#sign-in-modal').modal();
                }
                if(signUpError){
                    $('#sign-up-modal').modal();
                }

                $(window).on('scroll', function () {
                    var scrollPos = $(this).scrollTop();
                    if (scrollPos >= 20) {
                        $(".header").addClass("fixed-nav");
                        $('.btn', $('header')).removeClass('btn-outline-light').addClass('btn-outline-success')
                    } else {
                        $(".header").removeClass("fixed-nav");
                        $('.btn', $('header')).removeClass('btn-outline-success').addClass('btn-outline-light')
                    }
                })
            });
        </script>
    </body>
</html>
