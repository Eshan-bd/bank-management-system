@extends('layouts.customer.customerlayout')

@section('title')
    Payment
@endsection


@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="{{ route('account.payment') }}" class="form form-control" method="POST">
                {{ csrf_field() }}
                <table id="transactions" class="table table-condensed">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            Payment:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if ($message = Session::get('payerror'))
                            <tr>
                                <td>
                                    <strong class="text text-danger" id="validation_msg">{{ $message }}</strong>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    <tr>
                        <td>
                            Payment code:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="paymentcode" id="paymentcode" style="border-bottom: 2px solid black" placeholder="Payment Code">
                        </td>
                        @error('paymentcode')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Remarks:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="remarks" id="remarks" style="border-bottom: 2px solid black" placeholder="Remarks (Optional)">
                        </td>
                        @error('remarks')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Payment Amount:
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
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px;">
                    <button type="submit" class="btn btn-outline-dark">Pay</button>
                    <a href="{{ route('account.dashboard') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
                </div>
            </form>
        </div>
    </div>
    
@endsection