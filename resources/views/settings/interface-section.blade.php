<div class="card">
    <div class="card-header" id="interface-header">
        <h2 class="mb-0">
            <button class="btn shadow-none" type="button" data-toggle="collapse" data-target="#section-interface" aria-expanded="true" aria-controls="collapseOne">
                Interface
            </button>
        </h2>
    </div>
    <div id="section-interface"
         class="collapse @if($errors->has('date_format')
                                                  || $errors->has('time_format')
                                                  || $errors->has('week_start')
                                                  || $errors->has('limit')
                                                  || $errors->has('main_currency')
                                                  || $errors->has('currencies.*'))
                                                  show @endif"
         aria-labelledby="interface-header"
         data-parent="#accordion-settings">
        <div class="card-body">
            <form method="POST" action="{{route("settings:interface")}}">
            @csrf
            <div class="form-group row">
                <label for="date-format-select" class="col-md-4 col-lg-4 col-form-label">Date format</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('date_format') is-invalid @enderror"
                            id="date-format-select"
                            name="date_format">
                        <option value="Y/m/d" @if(old('date_format', $dateFormat) == "Y/m/d") selected @endif>YYYY/MM/DD ({{date("Y/m/d")}})</option>
                        <option value="m/d/Y" @if(old('date_format', $dateFormat) == "m/d/Y") selected @endif>MM/DD/YYYY ({{date("m/d/Y")}})</option>
                        <option value="d/m/Y" @if(old('date_format', $dateFormat) == "d/m/Y") selected @endif>DD/MM/YYYY ({{date("d/m/Y")}})</option>
                        <option value="d.m.Y" @if(old('date_format', $dateFormat) == "d.m.Y") selected @endif>DD.MM.YYYY ({{date("d.m.Y")}})</option>
                        <option value="d-m-Y" @if(old('date_format', $dateFormat) == "d-m-Y") selected @endif>DD-MM-YYYY ({{date("d-m-Y")}})</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'date_format'])
                </div>
            </div>
            <div class="form-group row">
                <label for="time-format-select" class="col-md-4 col-lg-4 col-form-label">Time format</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('time_format') is-invalid @enderror"
                            id="time-format-select"
                            name="time_format">
                        <option value="H:i" @if(old('time_format', $timeFormat) == "H:i") selected @endif>HH:MM ({{date("H:i")}})</option>
                        <option value="h:i A" @if(old('time_format', $timeFormat) == "h:i A") selected @endif>hh:mm A ({{date("h:i A")}})</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'time_format'])
                </div>
            </div>
            <div class="form-group row">
                <label for="week-start-select" class="col-md-4 col-lg-4 col-form-label">Week start</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('week_start') is-invalid @enderror"
                            id="week-start-select"
                            name="week_start">
                        <option value="0" @if(old('week_start', $weekStart) == 0) selected @endif>Sunday</option>
                        <option value="1" @if(old('week_start', $weekStart) == 1) selected @endif>Monday</option>
                        <option value="2" @if(old('week_start', $weekStart) == 2) selected @endif>Tuesday</option>
                        <option value="3" @if(old('week_start', $weekStart) == 3) selected @endif>Wednesday</option>
                        <option value="4" @if(old('week_start', $weekStart) == 4) selected @endif>Thursday</option>
                        <option value="5" @if(old('week_start', $weekStart) == 5) selected @endif>Friday</option>
                        <option value="6" @if(old('week_start', $weekStart) == 6) selected @endif>Saturday</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'week_start'])
                </div>
            </div>
            <div class="form-group row">
                <label for="entries-per-page-select" class="col-md-4 col-lg-4 col-form-label">Entries per page</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('limit') is-invalid @enderror"
                            id="entries-per-page-select"
                            name="limit">
                        <option value="10" @if(old('limit', $limit) == 10) selected @endif>10</option>
                        <option value="20" @if(old('limit', $limit) == 20) selected @endif>20</option>
                        <option value="25" @if(old('limit', $limit) == 25) selected @endif>25</option>
                        <option value="50" @if(old('limit', $limit) == 50) selected @endif>50</option>
                        <option value="100" @if(old('limit', $limit) == 100) selected @endif>100</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'limit'])
                </div>
            </div>
            <div class="form-group row">
                <label for="main-currency-select" class="col-md-4 col-lg-4 col-form-label">Main currency</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('main_currency') is-invalid @enderror"
                            id="main-currency-select"
                            name="main_currency">
                        <option value="ILS" @if(old('main_currency', $mainCurrency) == "ILS") selected @endif>ILS Israeli new shekel</option>
                        <option value="USD" @if(old('main_currency', $mainCurrency) == "USD") selected @endif>USD United States Dollar</option>
                        <option value="EUR" @if(old('main_currency', $mainCurrency) == "EUR") selected @endif>EUR Euro</option>
                        <option value="GBP" @if(old('main_currency', $mainCurrency) == "GBP") selected @endif>GBP British pound</option>
                        <option value="JPY" @if(old('main_currency', $mainCurrency) == "JPY") selected @endif>JPY Japanese yen</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'main_currency'])
                </div>
            </div>
            <div class="form-group row">
                <label for="additional-currencies-select" class="col-md-4 col-lg-4 col-form-label">Additional currencies</label>
                <div class="col-md-8 col-lg-8">
                    <select class="form-control @error('currencies.*') is-invalid @enderror"
                            id="additional-currencies-select"
                            name="currencies[]" multiple>
                        <option value="ILS" @if(in_array("ILS", old('currencies', $currencies))) selected @endif>ILS Israeli new shekel</option>
                        <option value="USD" @if(in_array("USD", old('currencies', $currencies))) selected @endif>USD United States Dollar</option>
                        <option value="EUR" @if(in_array("EUR", old('currencies', $currencies))) selected @endif>EUR Euro</option>
                        <option value="GBP" @if(in_array("GBP", old('currencies', $currencies))) selected @endif>GBP British pound</option>
                        <option value="JPY" @if(in_array("JPY", old('currencies', $currencies))) selected @endif>JPY Japanese yen</option>
                    </select>
                    @include('utils.error-invalid-feedback', ["errorField" => 'currencies.*'])
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