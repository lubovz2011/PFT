<div class="card">
    <div class="card-header hover-disabled" id="personal-info-header">
        <div class="row text-secondary text-center account-mini-headers">
            <div class="col">{{$date}}</div>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @foreach($transactions as $transaction)
                @include('transactions.transactions-manage-item')
            @endforeach
        </ul>
    </div>
</div>
