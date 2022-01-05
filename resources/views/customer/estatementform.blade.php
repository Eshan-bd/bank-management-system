@extends('layouts.customer.customerlayout')

@section('title')
    Download E-Statement
@endsection


@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="{{ route('account.statement') }}" method="post">
                {{ csrf_field() }}
                <table id="transactions" class="table table-borderless">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            E-Statement:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>From:</td>
                        <td><input class="form form-control" type="date" name="from"></td>
                        <td>To:</td>
                        <td><input class="form form-control" type="date" name="to"></td>
                        <td><input type="submit" class="btn btn-outline-danger" value="Download E-Statement"></td>
                    </tr>
                    <tr>
                        <td></td>
                        @error('from')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                        <td></td>
                        @error('to')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                        <td></td>
                    </tr>
                </table>
            </form>
            
            <div style="margin: auto; margin-right: 0px;">
                <a href="{{ route('account.dashboard') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
            </div>
        </div>
    </div>
    
@endsection