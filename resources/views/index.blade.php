@extends('public-layout')
@section('content')
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
                                    Overview your total incomes and expenses in one place.
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
        <section class="contact-us pb-50" data-scroll-index="2">
            <div class="container">
                <!--==== Section Heading Text =====-->
                <div class="section-header">
                    <div class="row">
                        <div class="col">
                            <div class="heading-2">
                                <h2 class="text-grediant d-inline-block text-center w-100">Contact Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2">
                        @if (session('send-status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('send-status') }}
                            </div>
                        @endif
                        <form class="index-form" method="POST" action="{{route('contact-us')}}">
                            @csrf
                            <div class="row">
                                <div class="col aos-init aos-animate" data-aos="fade-up" data-aos-duration="400">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control @error('contact-email') is-invalid @enderror"
                                            placeholder="email@example.com"
                                            name="contact-email"
                                            value="{{old('contact-email')}}"
                                            autocomplete="off">
                                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-email'])
                                    </div>
                                </div>
                                <div class="col aos-init aos-animate" data-aos="fade-up" data-aos-duration="600">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('contact-subject') is-invalid @enderror"
                                               placeholder="Subject"
                                               name="contact-subject"
                                               value="{{old('contact-subject')}}"
                                               autocomplete="off">
                                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-subject'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                                    <div class="form-group">
                                        <textarea type="text"
                                                  class="form-control @error('contact-message') is-invalid @enderror"
                                                  rows="5"
                                                  placeholder="Enter your message"
                                                  name="contact-message">{{old('contact-message')}}
                                        </textarea>
                                        @include('utils.error-invalid-feedback', ['errorField' => 'contact-message'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-center mt-2">
                                    <button class="btn btn-secondary mr-2 px-3"
                                            type="reset"
                                            data-dismiss="modal"
                                            aria-label="Close">
                                        Clear
                                    </button>
                                    <button class="btn btn-success px-4"
                                            type="submit">
                                        Send message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script src="/js/scrollIt.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function(){
            AOS.init();
            $.scrollIt();
            let signInError = {{($errors->has('login') || $errors->has('password')) ? 1 : 0}};
            let signUpError = {{($errors->has('signup_login') || $errors->has('signup_password')) ? 1 : 0}};

            @if (session('send-status') || $errors->hasAny(['contact-email', 'contact-subject', 'contact-message']))
            $('.js-contact-us-scroll-button').click();
            @endif

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
@endsection
