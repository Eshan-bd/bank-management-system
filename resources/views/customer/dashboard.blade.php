@extends('layouts.customer.customerlayout')

@section('title')
    Acount Home
@endsection

@section('customercontent')
    <div class="flex-container">
        <div class="flex-item">
            <h1 id="customer">
                Welcome, {{ $user->firstname }}&nbsp;{{ $user->lastname }}!
            </h1>
            <p id="customer">
                &#9656 Balance (BDT): {{ $account->accountbalance }}/-
                <br>&#9656 You have {{ $count }} beneficiaries.
                <br>&#9656 Your last transection (
                    @if ($history->credit!=0.00)
                        credit
                    @endif
                    @if ($history->debit!=0.00)
                        debit
                    @endif
                ) of TK.
                    @if ($history->credit!=0.00)
                        {{ $history->credit }}/-
                    @endif
                    @if ($history->debit!=0.00)
                        {{ $history->debit }}/-
                    @endif
                <br>
                
                on {{ $date }}, was: {{ $history->remarks }}.
            </p>
        </div>
    </div>
@endsection