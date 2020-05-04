@extends("layout")
@section("style")
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accounts</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col">
                            <button type="submit" class="btn btn-primary mr-3">Connect Digital Account</button>
                            <button type="button" class="btn btn-secondary">Create Cash Wallet</button>
                        </div>
                    </div>
                    <div class="row mt-5 text-secondary">
                        <div class="col">ACCOUNT NAME</div>
                        <div class="col">ACCOUNT TYPE</div>
                        <div class="col">CURRENT BALANCE</div>
                        <div class="col">TURN ON/OFF</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-settings">
                        <div class="card">
                            <div class="card-header py-3" id="personal-info-header">
                                <div class="row">
                                    <div class="col text-uppercase"><i class="fas fa-wallet mr-3 category-icon text-secondary"></i>cash wallets</div>
                                    <div class="col"></div>
                                    <div class="col">100 ILS</div>
                                    <div class="col">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                            <label class="custom-control-label " for="bank-category-toggle"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item py-3">
                                        <div class="row">
                                            <div class="col">Wallet</div>
                                            <div class="col">Cash</div>
                                            <div class="col">25 ILS</div>
                                            <div class="col">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                                    <label class="custom-control-label " for="bank-category-toggle"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <div class="row">
                                            <div class="col">Piggy Bank</div>
                                            <div class="col">Cash</div>
                                            <div class="col">75 ILS</div>
                                            <div class="col">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                                    <label class="custom-control-label " for="bank-category-toggle"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--<ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bank Fees
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                <label class="custom-control-label " for="bank-category-toggle"></label>
                            </div>
                        </li>

                    </ul>--}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("scripts")
    <script>
        $(document).ready(function(){
            $("select").select2({
                theme : "bootstrap"
            });
        });
    </script>
@endsection


