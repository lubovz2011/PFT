@extends("layout")
@section("style")
@endsection
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
            <div class="card shadow-card border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="media">
                        <span class="round-user-icon-container border border-success rounded-circle text-success content-box mr-3">
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <div class="media-body">
                            <h5 class="uname-header">{{$userName}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-settings">
                        <div class="card">
                            <div class="card-header" id="personal-info-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-personal-info" aria-expanded="true" aria-controls="collapseOne">
                                        Personal Info
                                    </button>
                                </h2>
                            </div>
                            <div id="section-personal-info" class="collapse" aria-labelledby="personal-info-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form method="POST" action="{{route("settings:personal-info")}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="user name" name="name" value="{{$name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" placeholder="email@example.com" name="login" value="{{$login}}">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <button class="btn btn-secondary" type="submit">Delete Profile</button>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="interface-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-interface" aria-expanded="true" aria-controls="collapseOne">
                                        Interface
                                    </button>
                                </h2>
                            </div>
                            <div id="section-interface" class="collapse" aria-labelledby="interface-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form method="POST" action="{{route("settings:interface")}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="date-format-select" class="col-md-4 col-lg-4 col-form-label">Date format</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="date-format-select" name="date_format">
                                                    <option value="Y/m/d" @if($dateFormat == "Y/m/d") {{"selected"}} @endif>YYYY/MM/DD ({{date("Y/m/d")}})</option>
                                                    <option value="m/d/Y" @if($dateFormat == "m/d/Y") {{"selected"}} @endif>MM/DD/YYYY ({{date("m/d/Y")}})</option>
                                                    <option value="d/m/Y" @if($dateFormat == "d/m/Y") {{"selected"}} @endif>DD/MM/YYYY ({{date("d/m/Y")}})</option>
                                                    <option value="d.m.Y" @if($dateFormat == "d.m.Y") {{"selected"}} @endif>DD.MM.YYYY ({{date("d.m.Y")}})</option>
                                                    <option value="d-m-Y" @if($dateFormat == "d-m-Y") {{"selected"}} @endif>DD-MM-YYYY ({{date("d-m-Y")}})</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="time-format-select" class="col-md-4 col-lg-4 col-form-label">Time format</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="time-format-select" name="time_format">
                                                    <option value="H:i" @if($timeFormat == "H:i") {{"selected"}} @endif>HH:MM ({{date("H:i")}})</option>
                                                    <option value="h:i A" @if($timeFormat == "h:i A") {{"selected"}} @endif>hh:mm A ({{date("h:i A")}})</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="week-start-select" class="col-md-4 col-lg-4 col-form-label">Week start</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="week-start-select" name="week_start">
                                                    <option value="0" @if($weekStart == 0) {{"selected"}} @endif>Sunday</option>
                                                    <option value="1" @if($weekStart == 1) {{"selected"}} @endif>Monday</option>
                                                    <option value="2" @if($weekStart == 2) {{"selected"}} @endif>Tuesday</option>
                                                    <option value="3" @if($weekStart == 3) {{"selected"}} @endif>Wednesday</option>
                                                    <option value="4" @if($weekStart == 4) {{"selected"}} @endif>Thursday</option>
                                                    <option value="5" @if($weekStart == 5) {{"selected"}} @endif>Friday</option>
                                                    <option value="6" @if($weekStart == 6) {{"selected"}} @endif>Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="entries-per-page-select" class="col-md-4 col-lg-4 col-form-label">Entries per page</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="entries-per-page-select" name="limit">
                                                    <option value="10" @if($limit == 10) {{"selected"}} @endif>10</option>
                                                    <option value="20" @if($limit == 20) {{"selected"}} @endif>20</option>
                                                    <option value="25" @if($limit == 25) {{"selected"}} @endif>25</option>
                                                    <option value="50" @if($limit == 50) {{"selected"}} @endif>50</option>
                                                    <option value="100" @if($limit == 100) {{"selected"}} @endif>100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="main-currency-select" class="col-md-4 col-lg-4 col-form-label">Main currency</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="main-currency-select" name="main_currency">
                                                    <option value="ILS" @if($mainCurrency == "ILS") {{"selected"}} @endif>ILS Israeli new shekel</option>
                                                    <option value="USD" @if($mainCurrency == "USD") {{"selected"}} @endif>USD United States Dollar</option>
                                                    <option value="EUR" @if($mainCurrency == "EUR") {{"selected"}} @endif>EUR Euro</option>
                                                    <option value="GBP" @if($mainCurrency == "GBP") {{"selected"}} @endif>GBP British pound</option>
                                                    <option value="JPY" @if($mainCurrency == "JPY") {{"selected"}} @endif>JPY Japanese yen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="additional-currencies-select" class="col-md-4 col-lg-4 col-form-label">Additional currencies</label>
                                            <div class="col-md-8 col-lg-8">
                                                <select class="form-control" id="additional-currencies-select" name="currencies[]" multiple>
                                                    <option value="ILS" @if(in_array("ILS", $currencies)) {{"selected"}} @endif>ILS Israeli new shekel</option>
                                                    <option value="USD" @if(in_array("USD", $currencies)) {{"selected"}} @endif>USD United States Dollar</option>
                                                    <option value="EUR" @if(in_array("EUR", $currencies)) {{"selected"}} @endif>EUR Euro</option>
                                                    <option value="GBP" @if(in_array("GBP", $currencies)) {{"selected"}} @endif>GBP British pound</option>
                                                    <option value="JPY" @if(in_array("JPY", $currencies)) {{"selected"}} @endif>JPY Japanese yen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="security-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#security-info" aria-expanded="true" aria-controls="collapseOne">
                                        Security
                                    </button>
                                </h2>
                            </div>
                            <div id="security-info" class="collapse" aria-labelledby="security-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form method="POST" action="{{route("settings:security")}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-md-4 col-lg-4 col-form-label">New password</label>
                                            <div class="col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="inputPassword" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPasswordConfirmation" class="col-md-4 col-lg-4 col-form-label">Password confirmation</label>
                                            <div class="col-md-8 col-lg-8">
                                                <input type="password" class="form-control" id="inputPasswordConfirmation" name="repeat">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="security-header">
                                <h2 class="mb-0">
                                    <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#email-notifications-info" aria-expanded="true" aria-controls="collapseOne">
                                        Email notifications
                                    </button>
                                </h2>
                            </div>
                            <div id="email-notifications-info" class="collapse" aria-labelledby="email-notifications-header" data-parent="#accordion-settings">
                                <div class="card-body">
                                    <form method="POST" action="{{route("settings:email-notifications")}}">
                                        @csrf
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="monthly-report" name="monthly_report" @if($monthlyReport) checked @endif>
                                            <label class="custom-control-label" for="monthly-report">Send monthly report</label>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-secondary mr-2" type="button">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
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

