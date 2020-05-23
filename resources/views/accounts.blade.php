@extends("layout")
@section("title")
    Accounts
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card shadow-card border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accounts</h5>
                </div>
                <div class="card-body pb-2">
                    <div class="row justify-content-start">
                        <div class="col">
                            <button type="submit" class="btn btn-primary mr-2">Connect Digital Account</button>
                            <button type="button" class="btn btn-secondary">Create Cash Wallet</button>
                        </div>
                    </div>
                    <div class="row mt-5 text-secondary text-center account-mini-headers">
                        <div class="col">ACCOUNT NAME</div>
                        <div class="col">ACCOUNT TYPE</div>
                        <div class="col">CURRENT BALANCE</div>
                        <div class="col">TURN ON/OFF</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-accounts">
                        <div class="card">
                            <div class="card-header py-3 hover-disabled" id="personal-info-header">
                                <div class="row">
                                    <div class="col text-uppercase"><i class="fas fa-wallet mr-3 category-icon text-secondary"></i>cash wallets</div>
                                    <div class="col"></div>
                                    <div class="col d-flex justify-content-center">100.10 ILS</div>
                                    <div class="col d-flex justify-content-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                            <label class="custom-control-label " for="bank-category-toggle"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @include('accounts.account-manage-item', ["id" => 1, "amount" => 25, "currency" => "ILS", "initialAmount" => 25, "accountType" => "cash", "accountName" => "Wallet"])
                                    @include('accounts.account-manage-item', ["id" => 2, "amount" => 75.10, "currency" => "ILS", "initialAmount" => 30, "accountType" => "cash", "accountName" => "Piggy Bank"])
                                </ul>
                            </div>
                        </div>
                    </div>
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

        $(".js-visibility-toggle").change(function(){
            $(this).closest(".input-group").find('.js-visibility-toggled').attr('readonly', function(_, attr){ return !attr}).focus();
            $(this).closest(".input-group-prepend").hide();
        })

        $(".js-visibility-toggled").blur(function(){
            $(this).closest(".input-group").find('.input-group-prepend').show();
            $(this).attr('readonly', function(_, attr){ return !attr});
        })
    </script>
@endsection


