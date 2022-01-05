@extends('layouts.customer.customerlayout')

@section('title')
    Account Details
@endsection



@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <div class="col-md-2 col-sm-4" style="margin: auto; margin-right: 0px;">
                <img src="/storage/account/profilepictures/{{ $user->userprofilepicture }}" id="user_profile_img" style="max-height: 200px; max-width:200px; border:2px solid black; border-radius:20px;">
            </div>
            <br>
            <table id="transactions" class="table table-condensed">
                <tr style="background-color: #263238; color: white;">
                    <td>
                        Personal Details:
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        First Name:
                    </td>
                    <td>
                        {{ $user->firstname }}
                    </td>
                    <td style="background-color: #263238; color: white;">
                        Last Name:
                    </td>
                    <td>
                        {{ $user->lastname }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Gender:
                    </td>
                    <td>
                        {{ $user->gender }}
                    </td>
                    <td style="background-color: #263238; color: white;">
                        Date of Birth:
                    </td>
                    <td>
                        {{ $user->dateofbirth }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Phone Number:
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td style="background-color: #263238; color: white;">
                        Email:
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        National Identity Number:
                    </td>
                    <td>
                        {{ $user->nid }}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <br>
            <table id="transactions" class="table table-condensed">
                <tr style="background-color: #263238; color: white;">
                    <td>
                        Account Details:
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Account Name:
                    </td>
                    <td>
                        {{ $account->accountname }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Account Type:
                    </td>
                    <td>
                        {{ $account->accounttype }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Interest Rate:
                    </td>
                    <td>
                        {{ $account->accountinterestrate }}%
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Account Balance:
                    </td>
                    <td>
                        {{ $account->accountbalance }}/- BDT
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #263238; color: white;">
                        Account Created:
                    </td>
                    <td>
                        {{ $created }}
                    </td>
                </tr>
            </table>
            <br>
            <table id="transactions" class="table table-condensed">
                <tr style="background-color: #263238; color: white;">
                    <td>Documents:</td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-8 col-sm-4" style="margin: auto; margin-right: 0px;">
                            <img src="/storage/account/accountdocuments/{{ $account->accountdocument }}" id="user_profile_img" style="max-height: 400px; max-width:400px; margin:auto; margin-right:0px; border:2px solid black; border-radius:20px;">
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px">
                <a href="{{ route('account.edit') }}"><button class="btn btn-outline-dark">Edit Profile</button></a>
                <a href="{{ route('account.changepassword') }}"><button class="btn btn-outline-dark">Change Password</button></a>
                <br><br><br><br>
            </div>
        </div>
    </div>
    
@endsection