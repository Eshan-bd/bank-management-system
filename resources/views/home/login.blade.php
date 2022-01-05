@extends('layouts.home.homelayout')
@section('title')
    Login
@endsection

@if (Session::get('accountid')||Session::get('adminid')||Session::get('empid'))
    @if (Session::get('adminid'))
        <script>window.location="{{ route('AdminDashboard') }}";</script>
    @elseif (Session::get('empid'))
        <script>window.location="{{ route('home.home') }}";</script>
    @elseif (Session::get('accountid'))
        <script>window.location="{{ route('account.dashboard') }}";</script>
    @endif
@endif

<style>
   

body{
        height: 100%;
        background: url("{{ asset('sysimages/loginPage.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

.Loginform legend{
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    

}

.Loginform {
        width:25%;
        margin:20px 450px;
        margin: auto;
        margin-top: 50px;
        padding:50px;
        border-radius: 10px;
        box-shadow: 0px 0px 30px black;
        background-color: #ddd; 
        color: #34495e;
       

      }

.Loginform legend{
        
        display:block;
        font-weight: bold;
        
}

.Loginform a{
    text-decoration: none;
    color: blue;
    
}

.Loginform a:hover{
    cursor: pointer;
    color: black;
}


.Loginform  input {
        display:block;
        width: 100%;
        border: 1px solid #000;
        padding:10px;
        border-radius: 100px;
        box-sizing: border-box;
        border-color:blue;
        
        outline:none;
        
      }
.Loginform  input:hover{
    border:40px;
    outline:none;
}

#submit{
        width: 100%;
        padding:5px;
        text-align: center;
        background-color: #063146;
        color: white;
        text-transform: uppercase; 
        font-weight: 900;
        border-bottom: 5px solid black;
        border-radius: 100px;
        cursor: pointer;
      }

#submit:hover {
        background-color: #ddd;
        color: black;
        
      }

#validation_msg{
          color:red;
      }

 #register{
        display:block;
        font-weight: bold;
        box-sizing: border-box;
        font size:25px
      }
</style>

@section('content')
  <div>
        <form action="{{ route('home.login') }}" method="post">
        <div class='Loginform'>
            {{ csrf_field() }}
            
            <center>
            <h3 style="font-size: 26px">Banking is now at your Doorstep!</h3>
            </center>
            <br>
                @if ($message = Session::get('loginerror'))
                    <strong id="validation_msg">{{ $message }}</strong>
                @endif
            

            
                <input type="text" name="username" placeholder="Enter your Username">
                @error('username')
                    <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                @enderror
                <br>
                <br>
            
                <input type="password" name="password" placeholder="Enter your Password">
                @error('password')
                    <span class="text text-danger" id="validation_msg">{{ $message }}</span>
                @enderror

                <br>
                <br>

                <button id="submit" type="submit" >LOGIN </button>
                <br>
                <br>
                <center>
                <span class="text text-info" id="register">Don't have an account? <a href="{{ route('account.register') }}">Create One!</a></span>
                </center>
               
            </div>
        </form>

        
    </div>
  
@endsection

