@extends("layout")
@section("style")

@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="" for="category-input">Name</label>
                                <input type="text" class="form-control" id="category-input" placeholder="">
                            </div>
                            <div class="col-auto">
                                <label class="" for="parent-category-select">Parent Category</label>
                                <select class="form-control" id="parent-category-select">
                                    <option value="0" selected>Without parent category</option>
                                    <option value="1">Education</option>
                                    <option value="2">Tax & Fees</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="icon-category-select"><i class="far fa-handshake"></i></label>
                                <select class="form-control" id="icon-category-select">
                                    <option value="0" selected></option>
                                    <option value="1"></option>
                                    <option value="2"></option>
                                </select>
                            </div>

                            <div class="col-auto">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-categories">
                        <div class="card">
                            <div class="card-header row py-3" id="category-bills" data-toggle="collapse" data-target="#sub-category-bills" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-file-invoice-dollar mr-2 category-icon text-secondary"></i> Bills
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-switch float-right">
                                        <input type="checkbox" class="custom-control-input" id="bills-category-toggle" checked>
                                        <label class="custom-control-label " for="bills-category-toggle"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="sub-category-bills" class="collapse" aria-labelledby="category-bills" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Internet
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="internet-category-toggle" checked>
                                                <label class="custom-control-label " for="internet-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Phone
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="phone-category-toggle" checked>
                                                <label class="custom-control-label " for="phone-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Rent
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="rent-category-toggle" checked>
                                                <label class="custom-control-label " for="rent-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-tax" data-toggle="collapse" data-target="#sub-category-tax" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-coins mr-2 category-icon text-secondary"></i> Tax & Fees
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-switch float-right">
                                        <input type="checkbox" class="custom-control-input" id="tax-category-toggle" checked>
                                        <label class="custom-control-label " for="tax-category-toggle"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="sub-category-tax" class="collapse" aria-labelledby="category-tax" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Bank Fees
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="bank-category-toggle" checked>
                                                <label class="custom-control-label " for="bank-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Service Fee
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="service-category-toggle" checked>
                                                <label class="custom-control-label " for="service-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Taxes
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="taxes-category-toggle" checked>
                                                <label class="custom-control-label " for="taxes-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-income" data-toggle="collapse" data-target="#sub-category-income" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-hand-holding-usd mr-2 category-icon text-secondary"></i> Income
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-switch float-right">
                                        <input type="checkbox" class="custom-control-input" id="income-category-toggle" checked>
                                        <label class="custom-control-label " for="income-category-toggle"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="sub-category-income" class="collapse" aria-labelledby="category-income" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Salary
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="salary-category-toggle" checked>
                                                <label class="custom-control-label " for="salary-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Bonus
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="bonus-category-toggle" checked>
                                                <label class="custom-control-label " for="bonus-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Investment Income
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="investment-category-toggle" checked>
                                                <label class="custom-control-label " for="investment-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row py-3" id="category-home" data-toggle="collapse" data-target="#sub-category-home" aria-expanded="true" aria-controls="collapseOne">
                                <div class="col">
                                    <i class="fas fa-home mr-2 category-icon text-secondary"></i> Home
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-switch float-right">
                                        <input type="checkbox" class="custom-control-input" id="home-category-toggle" checked>
                                        <label class="custom-control-label " for="home-category-toggle"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="sub-category-home" class="collapse" aria-labelledby="category-home" data-parent="#accordion-categories">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Home Services
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="services-category-toggle" checked>
                                                <label class="custom-control-label " for="services-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Decoration
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="decoration-category-toggle" checked>
                                                <label class="custom-control-label " for="decoration-category-toggle"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Home Supplies
                                            <div class="custom-control custom-switch float-right">
                                                <input type="checkbox" class="custom-control-input" id="supplies-category-toggle" checked>
                                                <label class="custom-control-label " for="supplies-category-toggle"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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
    </script>
@endsection


