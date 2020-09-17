@extends("layout")
@section("title")
    About-Us
@endsection
@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow-card border-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0">About-Us</h5>
                    </div>
                    <div class="card-body">
                        <h1 class="display-5 my-2">Our Mission</h1>
                        <p class="lead-1 mt-3">
                            The goal is to help you to get your finances into the shape so that you don't need to stress about every expense.<br>
                            If you know how much and what on you spend, it is easier to change your financial habits, if you feel like that's what you need.<br>
                            Having a complete picture of your finances in one place, make them easier to manage.<br>
                            Our mission here is to help you leave your financial ghosts behind, overcome your financial fears and treat yourself with financial wisdom instead.
                        </p>
                        <h1 class="display-5 mt-5 mb-4">Our Team</h1>
                        <div class="d-flex justify-content-center">
                            <div class="card mb-3 our-team">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="/images/me.jpg" class="card-img" alt="luba">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title lead-3">Lubov Langleben</h5>
                                            <p class="card-text lead-2 mb-3">
                                                Software engineering student.<br>
                                                Initiator and developer of PFT.<br>
                                            </p>
                                            <p class="text-muted text-left mt-2 mb-0">- Never give up</p>
                                            <p class="font-italic text-muted text-right m-0">make your dreams come true.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  Categories list accordion  --}}
                    <div class="card-body p-0">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
