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
                            <button type="submit"
                                    class="btn btn-primary mr-2"
                                    data-target="#connect-digital-account"
                                    data-toggle="modal">
                                Connect Digital Account
                            </button>
                            @include('modals.connectDigitalAccount')
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
                                                <i class="far fa-credit-card mr-3 category-icon text-secondary"></i>banks and cards
                                            </div>
                                        @endif
                                            <div class="col d-flex justify-content-end">
                                                <span class="mr-2 @if($group->sum('balanceInUserCurrency') >= 0) text-success @else text-danger @endif font-weight-bold">
                                                    {{\App\Helpers\Helpers::NumberFormat($group->sum('balanceInUserCurrency'))}}
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

            @if($errors->has('bank') || $errors->has('user-id') || $errors->has('password'))
                $('#connect-digital-account').modal();
            @endif

            $('.js-synchronize-buttom').on('click', function (){
                loaderStart();
                $.ajax({
                    method:"POST",
                    url: '{{route('synchronize-account')}}',
                    data: {
                        "id" : $(this).data('account'),
                    }
                }).done(function (data){
                    let balanceElement = $('li[data-target="#collapse-' + data.id + '"] .js-account-balance');
                    balanceElement.text(number_format(data.balance,2));
                    if(data.balance >= 0)
                        balanceElement.removeClass('text-danger').addClass('text-success');
                    else
                        balanceElement.removeClass('text-success').addClass('text-danger');
                   loaderStop();
                });
            });
        });


    </script>
@endsection


