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
                                                    <div class="text-success mr-2 font-weight-bold">1000.90</div>
                                                    <div class="text-secondary">ILS</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-center">
                                            1 - 3 of 1
                                            <div class="btn-group btn-group-sm ml-2" role="group">
                                                <button type="button" class="btn btn-secondary border-white border-right-0">
                                                    <i class="mx-1 fas fa-chevron-left"></i>
                                                </button>
                                                <button type="button" class="btn btn-secondary border-white" disabled>
                                                    <i class="mx-1 fas fa-chevron-right"></i>
                                                </button>
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
