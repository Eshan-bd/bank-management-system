@extends('layouts.customer.customerlayout')

@section('title')
    Edit Profile
@endsection



@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <form action="{{ route('account.edit') }}" class="form form-control" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px;">
                    <img src="/storage/account/profilepictures/{{ $user->userprofilepicture }}" id="user_profile_img" style="max-height: 200px; max-width:200px; border:2px solid black; border-radius:20px;">
                    <br><br>
                </div>
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 25px;">
                    <input type="file" name="profilepicture" id="profile" onclick="(this.style='display: inline-block; margin:10px; color: black; border:2px solid white; border-radius: 5px;')" style="display:none;">
                    <label for="profile"><strong class="btn btn-outline-dark">Change Profile picture</strong></label>
                    <br>
                    @error('profilepicture')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                    @enderror
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
                        <td>
                            First Name:
                        </td>
                        <td>
                            {{ $user->firstname }}
                        </td>
                        <td>
                            Last Name:
                        </td>
                        <td>
                            {{ $user->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Gender:
                        </td>
                        <td>
                            {{ $user->gender }}
                        </td>
                        <td>
                            Date of Birth:
                        </td>
                        <td>
                            {{ $user->dateofbirth }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone Number:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="phone" id="phone" style="border-bottom: 2px solid black" value="{{ $user->phone }}">
                        </td>
                        <td>
                            @error('phone')
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="email" id="email" style="border-bottom: 2px solid black" value="{{ $user->email }}">
                        </td>
                        <td>
                            @error('email')
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
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
                        <td>
                            Account Name:
                        </td>
                        <td>
                            <input type="text" class="form form-control" name="accountname" id="accountname" style="border-bottom: 2px solid black" value="{{ $account->accountname }}">
                        </td>
                        @error('accountname')
                            <td>
                                <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                            </td>
                        @enderror
                    </tr>
                    <tr>
                        <td>
                            Account Type:
                        </td>
                        <td>
                            {{ $account->accounttype }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Interest Rate:
                        </td>
                        <td>
                            {{ $account->accountinterestrate }}%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Account Balance:
                        </td>
                        <td>
                            {{ $account->accountbalance }}/- BDT
                        </td>
                    </tr>
                </table>
                <br>
                <div class="col-md-3 col-sm-4" style="margin: auto; margin-right: 0px">
                    <a href="{{ route('account.edit') }}"><button type="submit" class="btn btn-outline-dark">Update Profile</button></a>
                    <a href="{{ route('account.profile') }}"><button class="btn btn-outline-dark">Go Back</button></a>
                    <br><br><br><br>
                </div>
            </form>
        </div>
    </div>
    
@endsection