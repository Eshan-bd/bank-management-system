@extends('layouts.customer.customerlayout')

@section('title')
    Add beneficiary
@endsection


@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="{{ route('account.addbeneficiary') }}" class="form form-control" method="POST">
                {{ csrf_field() }}
                <table id="transactions" class="table table-condensed">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            Add Beneficiary:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if ($message = Session::get('addbeneficiaryerror'))
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
                            Beneficiary Name:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="beneficiaryname" id="beneficiaryname" style="border-bottom: 2px solid black" placeholder="Beneficiary Name">
                        </td>
                        @error('beneficiaryname')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Beneficiary Account Name:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="beneficiaryaccountname" id="beneficiaryaccountname" style="border-bottom: 2px solid black" placeholder="Beneficiary Account Name">
                        </td>
                        @error('beneficiaryaccountname')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                </table>
                <br>
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px">
                    <button type="submit" class="btn btn-outline-dark">Add To Beneficiary</button>
                    <a href="{{ route('account.profile') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
                    <br><br><br><br>
                </div>
            </form>
        </div>
    </div>
    
@endsection