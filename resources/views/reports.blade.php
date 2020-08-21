@extends("layout")
@section("title")
    Reports
@endsection
@section("content")

    <div class="container-fluid dynamic-height">
        <div class="row">
            <div class="col-3 bg-dark filters-form">
                @include('side-bar.filters-form')
            </div>
            <div class="col-9">
                <div class="card shadow-card border-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Reports</h5>
                    </div>
                    <div class="card-body p-0">
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row py-1">
                                        <div class="col">
                                            <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                                                <label class="btn btn-primary border-0 m-0">
                                                    <input type="radio" name="options" id="option1"> All Types
                                                </label>
                                                <label class="btn btn-secondary border-white border-top-0 border-bottom-0 m-0">
                                                    <input type="radio" name="options" id="option2"> Expense
                                                </label>
                                                <label class="btn btn-secondary border-0 m-0">
                                                    <input type="radio" name="options" id="option3"> Income
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-center">
                                            {{date('F, Y')}}
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
                                    <div class="row justify-content-center">
                                        <div class="col-5 my-2">
                                            <canvas id="myChart" width="400" height="400"></canvas>
                                        </div>
                                    </div>
                                    <div class="row mt-5 text-secondary text-center account-mini-headers">
                                        <div class="col-5 text-left">CATEGORY NAME</div>
                                        <div class="col">TRANSACTIONS</div>
                                        <div class="col">AMOUNT</div>
                                        <div class="col">PERCENT</div>
                                    </div>
                                </li>
                                <li class="list-group list-group-flush">

                                    <div class="accordion" id="accordion-categories">
                                        @php /** @var \App\Models\Category[] $categories*/ @endphp
                                        @foreach($categories->where('parent_id', '=', null) as $category)
                                            <div class="card">
                                                <div class="card-header row py-3" id="category-{{$category->id}}" data-toggle="collapse" data-target="#sub-category-{{$category->id}}">
                                                    <div class="col-5">
                                                        <i class="{{$category->icon}} mr-2 category-icon text-secondary"></i> {{$category->name}}
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-center">{{$category->getTransactionsCountForReport($transactions, $categories)}}</div>
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <div class="mr-2">-30.00</div>
                                                        <div class="text-secondary">ILS</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-center text-danger">45%</div>
                                                    </div>
                                                </div>
                                                @if($categories->where('parent_id', '=', $category->id)->count())
                                                    <div id="sub-category-{{$category->id}}" class="collapse" aria-labelledby="category-bills" data-parent="#accordion-categories">
                                                        <div class="card-body p-0">
                                                            <ul class="list-group list-group-flush">
                                                                @foreach($categories->where('parent_id', '=', $category->id) as $subCategory)
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center px-1">
                                                                        <div class="col-5">
                                                                            <i class="{{$subCategory->icon}} invisible mr-2 category-icon text-secondary"></i> {{$subCategory->name}}
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="text-center">{{$subCategory->getTransactionsCountForReport($transactions, $categories)}}</div>
                                                                        </div>
                                                                        <div class="col d-flex justify-content-center">
                                                                            <div class="mr-2">-30.00</div>
                                                                            <div class="text-secondary">ILS</div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="text-center text-danger">45%</div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{--<div class="card-body p-0">
                        <div class="accordion" id="accordion-accounts">
                            @foreach($transactionsByDate as $date => $transactions)
                                @include('transactions.transactions-manage-date', ["date" => $date, "transactions" => $transactions])
                            @endforeach
                        </div>
                    </div>--}}
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

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Education', 'Bills', 'Pets', 'Income', 'Home'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    /*scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }*/
                }
            });

        });
    </script>
@endsection
