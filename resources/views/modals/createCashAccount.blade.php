<div class="modal fade show" id="create-wallet-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Cash Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('create-cash-account') }}">
                    @csrf
                    <div class="form-group">
                        <input name="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               placeholder="NAME">
                        @include('utils.error-invalid-feedback', ['errorField' => 'title'])
                    </div>
                    <div class="form-group">
                        <input name="balance"
                               type="text"
                               class="form-control @error('balance') is-invalid @enderror"
                               value="{{ old('balance') }}"
                               placeholder="AMOUNT">
                        @include('utils.error-invalid-feedback', ['errorField' => 'balance'])
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('currency') is-invalid @enderror" name="currency">
                            @foreach(\App\Classes\Utils\DataSets::getUserCurrencyOptions() as $key => $currency)
                                <option value="{{$key}}" @if(old('currency') == $key) selected @endif>{{$currency}}</option>
                            @endforeach
                        </select>
                        @include('utils.error-invalid-feedback', ['errorField' => 'currency'])
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 px-3" data-dismiss="modal" type="reset">Cancel</button>
                        <button class="btn btn-primary px-4" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
