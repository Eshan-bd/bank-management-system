@extends('layouts.customer.customerlayout')

@section('title')
    Loan Status Check
@endsection


@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <table id="transactions" class="table table-condensed">
                <tr style="background-color: #263238; color: white;">
                    <td>
                        Loan Requests:
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Loan Request Date</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Loan Status</th>
                    <th></th>
                </tr>
                @forelse ($loanrequests as $lr)
                    <tr>
                        <td>
                            {{ $lr->created_at }}
                        </td>
                        <td>
                            {{ $lr->loantype }}
                        </td>
                        <td>
                            {{ $lr->loanamount }}
                        </td>
                        <td>
                            {{ $lr->loanrequeststatus }}
                        </td>
                        <td>
                            @if ($lr->loanrequeststatus=="PENDING")
                                <a href="/account/loan/delete/{{ $lr->id }}">
                                    <button class="btn btn-outline-danger">
                                        Delete Request
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                <tr>
                    <td>
                        No loan Record Found
                    </td>
                    <td></td>
                </tr>
                @endforelse
            </table>
            
            <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px;">
                <a href="{{ route('account.dashboard') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
            </div>
        </div>
    </div>
    
@endsection