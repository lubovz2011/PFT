@extends("layout")
@section("title")
    Transactions
@endsection
@section("content")

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 bg-dark filters-form">
                @include('side-bar.filters-form', ["showTypeSelect" => true])
            </div>
            <div class="col-9">
                <div class="card shadow-card border-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Transactions</h5>
                    </div>
                    <div class="card-body p-0">
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row py-1">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col text-uppercase text-secondary account-mini-headers">Current Balance</div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-start">
                                                    <div class=" @if ($totalBalance >= 0) text-success @else text-danger @endif  mr-2 font-weight-bold">{{$totalBalance}}</div>
                                                    <div class="text-secondary">{{$currency}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-center">
                                            {{$first}} - {{$last}} of {{$transactionsCount}}
                                            <div class="btn-group btn-group-sm ml-2" role="group">
                                                <a href="{{route('transactions', ['page' => $page - 1])}}"
                                                   class="btn btn-secondary border-white border-right-0 @if($page < 2) disabled @endif">
                                                    <i class="mx-1 fas fa-chevron-left"></i>
                                                </a>
                                                <a href="{{route('transactions', ['page' => $page + 1])}}"
                                                   class="btn btn-secondary border-white @if($transactionsCount == $last) disabled @endif">
                                                    <i class="mx-1 fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col my-2">
                                            <button type="button"
                                                    class="btn btn-primary"
                                                    aria-pressed="false"
                                                    data-toggle="modal"
                                                    data-target="#add-transaction-modal">
                                                Add Transaction
                                            </button>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <form class="form-inline my-2">
                                                <input class="form-control mr-sm-2" type="search" placeholder="Search for transactions">
                                                <button class="btn btn-outline-primary" type="submit">Search</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordion-accounts">
                            @foreach($transactionsByDate as $date => $transactions)
                                @include('transactions.transactions-manage-date')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("modals.addTransaction")
@endsection
@section("scripts")
    <script>
        $(document).ready(function(){
            $("select").select2({
                theme : "bootstrap"
            });

            $('select[name="filter-times"]').select2({
                "placeholder" : "Select time",
                theme : "bootstrap"
            });

            $('select[name="filter-types"]').select2({
                "placeholder" : "Select type",
                theme : "bootstrap"
            });

            $('select[name="filter-accounts[]"]').select2({
                "placeholder" : "Select account",
                theme : "bootstrap"
            });

            $('select[name="filter-categories[]"]').select2({
                "placeholder" : "Select category",
                theme : "bootstrap"
            });

            @if(
               $errors->has('type') ||
               $errors->has('account') ||
               $errors->has('category') ||
               $errors->has('date') ||
               $errors->has('amount') ||
               $errors->has('description')
            )
                $('#add-transaction-modal').modal();
            @endif
        });
    </script>
@endsection
