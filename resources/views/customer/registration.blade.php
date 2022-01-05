@extends('layouts.home.homelayout')

@section('title')
    Account Registration
@endsection

@if (Session::get('accountid')||Session::get('adminid')||Session::get('empid'))
    @if (Session::get('adminid'))
        <script>window.location="{{ route('home.news') }}";</script>
    @elseif (Session::get('empid'))
        <script>window.location="{{ route('home.home') }}";</script>
    @elseif (Session::get('accountid'))
        <script>window.location="{{ route('home.aboutus') }}";</script>
    @endif
@endif

<style>
    #login{
        background-color: #2c6966;
        border-bottom: thick solid #18FFFF;
    }

    body, html {
        height: 100%;
        background: url("{{ asset('sysimages/bank_registration.jpeg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .flex-container-background {
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        flex-direction: column;
        overflow: auto;
        width: auto;
    }

    .flex-container {
        display: -webkit-flex;
        display: flex;
    }

    .flex-item {
        margin: auto;
        margin-top: 0px;
        background: transparent;
    }

    .flex-item-0 {
        margin: auto;
        width: 100%;
        background: linear-gradient(rgb(0, 0, 0), rgba(0, 0, 0, 0));
    }

    .flex-item-1 {
        margin: auto;
        margin-top: 50px;
        background: #21292cd7;
        width: 1200px;
        border-radius: 10px;
    }

    @media screen and (max-width: 540px) {
        .flex-item-1 {
            margin-top: 0px;
            width: 300px;
        }
    }

    @media screen and (max-width: 340px) {
        .flex-item-1 {
            margin-top: 0px;
            width: auto;
        }
    }

    h1[id="form_header"] {
        line-height: 60px;
        margin-left: 20px;
        font-family: Roboto-Thin;
        font-size: 50px;
        text-align: center;
        color: white;
    }

    /* Bordered form */
    form {
        margin-top: 0px;
        margin-bottom: 0px;
        border: 2px solid #f1f1f1;
        border-radius: 10px;
    }

    h2 {
        font-family: OpenSans-Light;
        color: white;
        font-size: 40px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        border-bottom: 2px solid white
        
    }

    .flex-item-login {
        margin: auto;
        margin-top: 0px;
        margin-bottom: 5px;
        background-color: transparent;
    }

    /* Full-width inputs */
    input[type=text], input[type=date] {
        font-family: Roboto-Regular;
        color: #212121;
        font-size: 18px;
        width: 97%;
        height: 40px;
        margin: 10px;
        padding: 1px 1px;
        bottom: 0;
        border: 0;
        box-sizing: border-box;
        background-color: white;
        border-radius: 3px;
    }

    label[id="profilepicture"] {
        font-family: Roboto-Regular;
        color: #212121;
        font-size: 18px;
        width: 100%;
        height: 40px;
        margin: 10px;
        padding: 5px 100px 5px 100px;
        bottom: 0;
        border: 2px solid #263238;
        background-color: rgb(255, 255, 255);
        border-radius: 10px;
    }

    input[name="firstname"], input[name="lastname"], input[name="gender"], input[type=password] {
        font-family: Roboto-Regular;
        color: #212121;
        font-size: 18px;
        width: 47.5%;
        height: 40px;
        margin: 10px;
        padding: 1px 1px;
        bottom: 0;
        border: 0;
        box-sizing: border-box;
        background-color: white;
        border-radius: 3px;
    }

    input[name="gender"], input[name="accounttype"], input[name="privacy"] {
        font-family: Roboto-Regular;
        color: #212121;
        font-size: 18px;
        width: 2%;
        height: 20px;
        margin: 10px;
        margin-right: 0px;
        padding: 1px 1px;
        bottom: 0;
        border: 0;
        box-sizing: border-box;
        background-color: white;
        border-radius: 3px;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        border: none;
        color: white;
        font-family: OpenSans-Regular;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin: 10px;
        margin-right: 10px;
        cursor: pointer;
        border-radius: 3px;
    }

    /* Add a hover effect for buttons */
    button:hover {
        opacity: 0.8;
    }

    span[id="validation_msg"]{
        color: red;
        margin-left: 20px;
    }

    span[id="register"]{
        text-align: center;
        color: white;
        font-size: 20px;
        margin-left: 10px;
    }

    a[id="create"]:hover {
        font-size: 23px;
        border: 1px solid white;
        border-radius: 5px;
    }

    strong[id="validation_msg"]{
        color: red;
        margin-left: 20px;
    }

    strong[id="gender-text"]{
        font-family: Roboto-Regular;
        color: white;
        font-size: 18px;
        margin-left: 20px;
    }

</style>

@section('content')
    <div class="flex-container-background">
        <div class="flex-container">
            <div class="flex-item-0">
                <h1 id="form_header">Explore the world with Castle Internet Banking...</h1>
            </div>
        </div>

        <div class="flex-container">
            <div class="flex-item-1">
                <form action="{{ route('account.register') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="flex-item-login">
                        <h2>Create Castle Bank Account:</h2>
                    </div>

                    <div class="flex-item">
                        @if ($message = Session::get('registererror'))
                            <strong id="validation_msg">{{ $message }}</strong>
                        @endif
                    </div>

                    <div class="flex-item">
                        <br>
                        <input type="file" name="profilepicture" id="profilepicture" onclick="(this.style='display: inline-block; margin:10px; color: white; border:2px solid white; border-radius: 5px;')" style="display:none;"/>
                        <label for="profilepicture" id="profilepicture">Click here to upload your profile picture</label>
                    </div>

                    <div class="flex-item">
                        @error('profilepicture')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <br>
                        <input type="text" name="firstname" placeholder="Enter your First Name" value="{{old('firstname')}}">
                        <input type="text" name="lastname" placeholder="Enter your Last Name" value="{{old('lastname')}}">
                    </div>

                    <div class="flex-item">
                        @error('firstname')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                        @error('lastname')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="radio" name="gender" id="genderM" value="Male"><label for="genderM"><strong id="gender-text">Male</strong></label>
                        <input type="radio" name="gender" id="genderF" value="Female"><label for="genderF"><strong id="gender-text">Female</strong></label>
                        <input type="radio" name="gender" id="genderO" value="Others"><label for="genderO"><strong id="gender-text">Others</strong></label>
                    </div>

                    <div class="flex-item">
                        @error('gender')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input placeholder="Date Of Birth" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateofbirth" value="{{old('dateofbirth')}}">
                    </div>

                    <div class="flex-item">
                        @error('dateofbirth')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="text" name="phone" placeholder="Enter your Phone No" value="{{old('phone')}}">
                    </div>

                    <div class="flex-item">
                        @error('phone')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="text" name="email" placeholder="Enter your Email" value="{{old('email')}}">
                    </div>

                    <div class="flex-item">
                        @error('email')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="text" name="nid" placeholder="Enter your NID No" value="{{old('nid')}}">
                    </div>

                    <div class="flex-item">
                        @error('nid')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <br>
                        <input type="file" name="niddoc" id="niddoc" onclick="(this.style='display: inline-block; margin-left:10px; color: white; border:2px solid white; border-radius: 5px;')" style="display:none;"/>
                        <label for="niddoc" id="profilepicture">Click here to upload NID (Front Side Picture)</label>
                    </div>

                    <div class="flex-item">
                        @error('niddoc')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <br>
                        <input type="text" name="accountname" placeholder="Enter your Account Username" value="{{old('accountname')}}">
                    </div>

                    <div class="flex-item">
                        @error('accountname')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="radio" name="accounttype" id="atS" value="Savings Account"><label for="atS"><strong id="gender-text">Savings Account</strong></label>
                        <input type="radio" name="accounttype" id="atSt" value="Student Account"><label for="atSt"><strong id="gender-text">Student Account</strong></label>
                        <input type="radio" name="accounttype" id="atB" value="Business Account"><label for="atB"><strong id="gender-text">Business Account</strong></label>
                    </div>

                    <div class="flex-item">
                        @error('accounttype')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <input type="password" name="password" placeholder="Enter your Password">
                        <input type="password" name="password_confirmation" placeholder="Re-enter your Password">
                    </div>

                    <div class="flex-item">
                        @error('password')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <br>
                        <input type="checkbox" name="privacy" id="privacy" value="yes">
                        <label for="privacy"><strong id="gender-text" style="color: red; margin-left: 0">*I agree to the Castle Bank's privacy policy and Financial Agreement.</strong></label>
                    </div>

                    <div class="flex-item">
                        @error('privacy')
                            <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-item">
                        <button type="submit">Create Account</button>
                        <span class="text text-info" id="register">Have an account? <a href="{{ route('home.login') }}" style="color: cyan" id="create">Login to Continue!</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection