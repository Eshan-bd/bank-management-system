@extends('Layouts.admin.admin')

@section('title')
{{'Edit Profile'}}
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

	<form action="/admin/editprofile/{{$bank->id}}/{{$admin->id}}" method="post" enctype="multipart/form-data" >
		{{csrf_field()}}

		<center>
			<img src=  "{{url('storage/admin/admin_cover_images/'.$bank->userprofilepicture)}}" 
			style="width: 200px; height:200px;">
			<br>
			<a style="text-decoration: none;" href="/admin/editpicture/{{$bank->id}}">Update Profile Pictrue</a>
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


		<label>Admin Name</label>
		<input class="form-control" type="text" name="ad_name"  value="{{$admin->adminname}}">
		@if($errors->has('ad_name'))
			<span class="text-danger">
				<strong> {{$errors->first('ad_name')}} </strong>
			</span>
		@endif <br>

		<label>Password</label>
		<input class="form-control" type="text" name="password" value="{{$admin->password}}" >
		@if($errors->has('password'))
			<span class="text-danger">
				<strong> {{$errors->first('password')}} </strong>
			</span>
		@endif <br>

		<label>Salary</label>
		<input class="form-control" type="text" name="sal"  value="{{$admin->adminsalary}}">
		@if($errors->has('sal'))
			<span class="text-danger">
				<strong> {{$errors->first('sal')}} </strong>
			</span>
		@endif 
		<br>

		<input class= "btn1" type="Submit"  name="update" value="update">
		<br>


	</form>
	
</fieldset>
</div>

@endsection