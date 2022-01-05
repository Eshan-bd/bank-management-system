@extends('layouts.customer.customerlayout')

@section('title')
    Transfer Fund
@endsection



@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="/account/tranfer-fund/{{ $benaccount->accountname }}" class="form form-control" method="POST">
                {{ csrf_field() }}
                <table id="transactions" class="table table-condensed">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            Transfer Fund:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if ($message = Session::get('senderror'))
                            <tr>
                                <td>
                                    <strong class="text text-danger" id="validation_msg">{{ $message }}</strong>
                                </td>
                                <td></td>
                            </tr>
                        @endif
                    <tr>
                        <td>
                            Beneficiary Name:
                        </td>
                        <td>
                            {{ $beneficiary->beneficiaryname }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Beneficiary Account Name:
                        </td>
                        <td>
                            {{ $benaccount->accountname }}
                        </td>
                        @error('beneficiaryaccountname')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Tranfer Amount:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="amount" id="amount" style="border-bottom: 2px solid black" placeholder="Amount">
                        </td>
                        @error('amount')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Your Password:
                        </td>
                        <td>
                            <input type="password" class="form form-control" name="password" id="password" style="border-bottom: 2px solid black" placeholder="Enter Password">
                        </td>
                        @error('password')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                </table>
                <br>
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px">
                    <button type="submit" class="btn btn-outline-dark">Send</button>
                    <a href="{{ route('account.beneficiarylist') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
                    <br><br><br><br>
                </div>
            </form>
        </div>
    </div>
    
@endsection