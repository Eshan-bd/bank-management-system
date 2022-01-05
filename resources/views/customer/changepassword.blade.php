@extends('layouts.customer.customerlayout')

@section('title')
    Change Password
@endsection



@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="{{ route('account.changepassword') }}" class="form form-control" method="POST">
                {{ csrf_field() }}
                <table id="transactions" class="table table-condensed">
                    <tr style="background-color: #263238; color: white;">
                        <td>
                            Change Password:
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            Old Password:
                        </td>
                        <td>
                            <input type="password" class="form form-control" name="oldpassword" id="oldpassword" style="border-bottom: 2px solid black" placeholder="Old Password">
                        </td>
                        @error('oldpassword')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                        @if ($message = Session::get('changepassworderror'))
                            <td>
                                <strong id="validation_msg">{{ $message }}</strong>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            New Password:
                        </td>
                        <td>
                            <input type="password" class="form form-control" name="password" id="password" style="border-bottom: 2px solid black" placeholder="New Password">
                        </td>
                        @error('password')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Confirm New Password:
                        </td>
                        <td>
                            <input type="password" class="form form-control" name="password_confirmation" id="password_confirmation" style="border-bottom: 2px solid black" placeholder="Confirm New Password">
                        </td>
                    </tr>
                </table>
                <br>
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px">
                    <button type="submit" class="btn btn-outline-dark">Change Password</button>
                    <a href="{{ route('account.profile') }}"><strong class="btn btn-outline-dark">Go Back</strong></a>
                    <br><br><br><br>
                </div>
            </form>
        </div>
    </div>
    
@endsection