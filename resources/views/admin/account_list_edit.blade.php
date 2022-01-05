@extends('Layouts.admin.admin')

@section('title')
{{'Account - '.$cus->accountname .' Profile'}}
@endsection

@section('content')
<style type="text/css">
	.form legend{
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    

}

.form {
        width:460px;
        margin: 10px 585px;
        padding:50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px black;
        margin-bottom: 50px;
        

      }
.form  label {
        display:block;
        font-weight: bold;
        text-transform: uppercase;

      }
.form legend{
        display:block;
        font-weight: bold;
        box-sizing: border-box;
}


.form  input {
        display:block;
        width: 100%;
        border: 1px solid #000;
        padding:5px;
        box-sizing: border-box;

      }

.btn1 {

	font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    background-color: #373b8b;
    color: white;
    border-radius: 100px;

}

.btn1:hover{
	background-color: white;
	color: black;
}

#gen{
	display: inline-block; width: 15%;
}
</style>

<div class="form">
	<fieldset>

	<form action="/admin/customerlist/edit/{{$bank->id}}" method="post" enctype="multipart/form-data" >
		{{csrf_field()}}

		<center>
			<img src=  "{{url('storage/account/profilepictures/'.$bank->userprofilepicture)}}" 
			style="width: 200px; height:200px;">
			<br>
			<a style="text-decoration: none;" href="/admin/customerlist/edit/picture/{{$bank->id}}">Update Profile Pictrue</a>
		</center>
		
		<br>
		<br>

		<label>First Name</label>
		<input class="form-control" type="text" name="f_name"  value="{{$bank->firstname}}">
		@if($errors->has('f_name'))
			<span class="text-danger">
				<strong> {{$errors->first('f_name')}} </strong>
			</span>
		@endif <br>

		<label>Last Name</label>
		<input class="form-control" type="text" name="l_name"  value="{{$bank->lastname}}">
		@if($errors->has('l_name'))
			<span class="text-danger">
				<strong> {{$errors->first('l_name')}} </strong>
			</span>
		@endif <br>



		<label>Gender</label>
		<input type="radio" name="gender" id="gen" value="Male" @if ($bank->gender == "Male") checked @endif> Male
		<input type="radio" name="gender" id="gen" value="Female" @if ($bank->gender == "Female") checked @endif> Female
		<input type="radio" name="gender" id="gen" value="Others" @if ($bank->gender == "Others") checked @endif> Others

		@if($errors->has('gender'))
			<span class="text-danger">
				<strong> {{$errors->first('gender')}} </strong>
			</span>
		@endif 
		
		<br>
		<br>

		<label> Date of Birth </label>
		<input class="form-control" type="date" name="dob"  value="{{$bank->dateofbirth}}">
		@if($errors->has('dob'))
			<span class="text-danger">
				<strong> {{$errors->first('dob')}} </strong>
			</span>
		@endif <br>

		<label> Phone </label>
		<input class="form-control" type="text" name="phone"  value="{{$bank->phone}}">
		@if($errors->has('phone'))
			<span class="text-danger">
				<strong> {{$errors->first('phone')}} </strong>
			</span>
		@endif <br>


		<label>Email</label>
		<input class="form-control" type="text" name="email"  value="{{$bank->email}}">
		@if($errors->has('email'))
			<span class="text-danger">
				<strong> {{$errors->first('email')}} </strong>
			</span>
		@endif <br>



		<label>Nid No</label>
		<input class="form-control" type="text" name="nid"  value="{{$bank->nid}}">
		@if($errors->has('nid'))
			<span class="text-danger">
				<strong> {{$errors->first('nid')}} </strong>
			</span>
		@endif <br>


		<label>Account Name</label>
		<input class="form-control" type="text" name="acc_name"  value="{{$cus->accountname}}">
		@if($errors->has('acc_name'))
			<span class="text-danger">
				<strong> {{$errors->first('acc_name')}} </strong>
			</span>
		@endif <br>

		<label>Account Type</label>
		<input type="radio" name="type" id="gen" value="Savings Account" @if ($cus->accounttype == "Savings Account") checked @endif> Savings Account
		<input type="radio" name="type" id="gen" value="Student Account" @if ($cus->accounttype == "Student Account") checked @endif> Student Account
		<input type="radio" name="type" id="gen" value="Business Account" @if ($cus->accounttype == "Business Account") checked @endif> Business Account

		@if($errors->has('type'))
			<span class="text-danger">
				<strong> {{$errors->first('type')}} </strong>
			</span>
		@endif <br> <br>

		<label>Password</label>
		<input class="form-control" type="text" name="password">
		@if($errors->has('password'))
			<span class="text-danger">
				<strong> {{$errors->first('password')}} </strong>
			</span>
		@endif <br>

		<label>Balance</label>
		<input class="form-control" type="text" name="bal"  value="{{$cus->accountbalance}}">
		@if($errors->has('bal'))
			<span class="text-danger">
				<strong> {{$errors->first('bal')}} </strong>
			</span>
		@endif 
		<br>

		

		<label>Upload Nid</label>
		<input class="from-control" type="file" name="doc"><br>

		<label>Account State </label>
		<input class="form-control" type="text" name="state"  value="{{$cus->accountstate}}">
		@if($errors->has('state'))
			<span class="text-danger">
				<strong> {{$errors->first('state')}} </strong>
			</span>
		@endif <br>

		

		<input class= "btn1" type="Submit"  name="update" value="update">
		<br>


	</form>
	
</fieldset>
</div>

@endsection