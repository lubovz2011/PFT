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
                            <button type="button"
                                    class="btn btn-secondary"
                                    data-target="#create-wallet-modal"
                                    data-toggle="modal">
                                Create Cash Wallet
                            </button>
                            @include('modals.createCashAccount')
                        </div>
                    </div>
                    <div class="row mt-5 text-secondary text-center account-mini-headers">
                        <div class="col-6 text-left">ACCOUNT NAME</div>
                        <div class="col text-right">CURRENT BALANCE</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-accounts">
                        @foreach($groups as $key => $group)
                            <div class="card">
                                <div class="card-header py-3 hover-disabled">
                                    <div class="row">
                                        @if($key == \App\Models\Account::TYPE_CASH)
                                            <div class="col text-uppercase">
                                                <i class="fas fa-wallet mr-3 category-icon text-secondary"></i>cash wallets
                                            </div>

                                        @elseif($key == \App\Models\Account::TYPE_CARD)
                                            <div class="col text-uppercase">
                                                <i class="fas fa-wallet mr-3 category-icon text-secondary"></i>cards
                                            </div>
                                        @endif
                                            <div class="col  d-flex justify-content-end">
                                                <span class="mr-2 @if($balance >= 0) text-success @else text-danger @endif font-weight-bold">
                                                    {{$balance}}
                                                </span>
                                                    {{$currency}}
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        @foreach($group as $account)
                                            @php /** @var \App\Models\Account $account */ @endphp
                                            @include('accounts.account-manage-item')
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
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

            @if($errors->has('title') || $errors->has('balance') || $errors->has('currency'))
                $('#create-wallet-modal').modal();
            @endif
        });


    </script>
@endsection


