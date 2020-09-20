@extends("layout")
@section("title")
    Transactions
@endsection
@section("content")
{{--Transactions view--}}
@php /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */ @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-md-block col-3 bg-dark filters-form">
                @include('side-bar.filters-form')
            </div>
            <div class="col-12 col-md-9">
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
                                                <div class="col text-uppercase text-secondary account-mini-headers">
                                                    Current Balance
                                                </div>
                                            </div>
                                            {{--current user balance in user main currency--}}
                                            <div class="row">
                                                <div class="col d-flex justify-content-start">
                                                    <div class="@if ($totalBalance >= 0) text-success @else text-danger @endif  mr-2 font-weight-bold">
                                                        {{$totalBalance}}
                                                    </div>
                                                    <div class="text-secondary">{{$currency}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--pagination--}}
                                        <div class="col d-flex justify-content-end align-items-center">
                                            @if(empty($paginator->total()))
                                                0 - 0
                                            @else
                                                {{$paginator->firstItem()}} - {{$paginator->lastItem()}}
                                            @endif
                                                of {{$paginator->total()}}
                                            <div class="btn-group btn-group-sm ml-2" role="group">
                                                <a href="{{$paginator->previousPageUrl()}}"
                                                   class="btn btn-secondary border-white border-right-0 @if($paginator->previousPageUrl() == null) disabled @endif">
                                                    <i class="mx-1 fas fa-chevron-left"></i>
                                                </a>
                                                <a href="{{$paginator->nextPageUrl()}}"
                                                   class="btn btn-secondary border-white @if($paginator->nextPageUrl() == null) disabled @endif">
                                                    <i class="mx-1 fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                {{--Add new transaction--}}
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
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordion-accounts">
                            @foreach($paginator->groupBy('date') as $date => $transactions)
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
