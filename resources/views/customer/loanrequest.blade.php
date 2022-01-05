@extends('layouts.customer.customerlayout')

@section('title')
    Loan Request
@endsection


@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <table id="transactions" class="table table-condensed">
                <tr style="background-color: #263238; color: white;">
                    <td>
                        Available Loan Types:
                    </td>
                    <td></td>
                </tr>
                @forelse ($loantypes as $lt)
                    <tr>
                        <td>
                            {{ $lt->type }}
                        </td>
                        <td>
                            {{ $lt->rate }}%
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
            <form action="{{ route('account.loanrequest') }}" class="form form-control" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table id="transactions" class="table table-condensed">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            Request Loan:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if ($message = Session::get('loanerror'))
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
                            Loan Type:
                        </td>
                        <td>
                            <select class="form form-control" name="loantype" id="loantype" style="border: 2px solid black; text-align: center;">
                                <option hidden disabled selected>--Select a Loan Type--</option>
                                @foreach ($loantypes as $lt)
                                    <option value="{{ $lt->type }}">{{ $lt->type }}</option>
                                @endforeach
                            </select>
                        </td>
                        @error('loantype')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Loan Amount:
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
                            Loan Document:
                        </td>
                        <td>
                            <input type="file" class="form form-control" name="loandoc" id="loandoc" style="border: 2px solid black; background-color: rgba(0, 0, 0, 0.096)">
                        </td>
                        @error('loandoc')
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
                    <button type="submit" class="btn btn-outline-dark">Place Request</button>
                    <a href="{{ route('account.dashboard') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
                </div>
            </form>
        </div>
    </div>
    
@endsection