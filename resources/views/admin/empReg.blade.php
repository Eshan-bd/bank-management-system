@extends('Layouts.admin.admin')

@section('title')
{{'Registration'}}
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
    text-transform: uppercase;\
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

<div class= "form">
	<fieldset>

	<form action="{{route ('CreateEmp') }}" method="post" enctype="multipart/form-data" >
		{{csrf_field()}}
		<legend>Employee Registration</legend>
		<br>
		<br>

		<label>First Name</label>
		<input class="form-control" type="text" name="f_name"  value="{{old('f_name')}}">
		@if($errors->has('f_name'))
			<span class="text-danger">
				<strong> {{$errors->first('f_name')}} </strong>
			</span>
		@endif <br>

		<label>Last Name</label>
		<input class="form-control" type="text" name="l_name"  value="{{old('l_name')}}">
		@if($errors->has('l_name'))
			<span class="text-danger">
				<strong> {{$errors->first('l_name')}} </strong>
			</span>
		@endif <br>



		<label>Gender</label>
		<input type="radio" name="gender" id="gen" value="Male"> Male
		<input type="radio" name="gender" id="gen" value="Female"> Female
		<input type="radio" name="gender" id="gen" value="Others"> Others

		@if($errors->has('gender'))
			<span class="text-danger">
				<strong> {{$errors->first('gender')}} </strong>
			</span>
		@endif 
		
		<br>
		<br>

		<label> Date of Birth </label>
		<input class="form-control" type="date" name="dob"  value="{{old('dob')}}">
		@if($errors->has('dob'))
			<span class="text-danger">
				<strong> {{$errors->first('dob')}} </strong>
			</span>
		@endif <br>

		<label> Phone </label>
		<input class="form-control" type="text" name="phone"  value="{{old('phone')}}">
		@if($errors->has('phone'))
			<span class="text-danger">
				<strong> {{$errors->first('phone')}} </strong>
			</span>
		@endif <br>


		<label>Email</label>
		<input class="form-control" type="text" name="email"  value="{{old('email')}}">
		@if($errors->has('email'))
			<span class="text-danger">
				<strong> {{$errors->first('email')}} </strong>
			</span>
		@endif <br>

		<label>Upload Picture</label>
		<input class="from-control" type="file" name="pic"><br>


		<label>Nid No</label>
		<input class="form-control" type="text" name="nid"  value="{{old('nid')}}">
		@if($errors->has('nid'))
			<span class="text-danger">
				<strong> {{$errors->first('nid')}} </strong>
			</span>
		@endif <br>


		<label>Employee Name</label>
		<input class="form-control" type="text" name="emp_name"  value="{{old('emp_name')}}">
		@if($errors->has('emp_name'))
			<span class="text-danger">
				<strong> {{$errors->first('emp_name')}} </strong>
			</span>
		@endif <br>

		<label>Password</label>
		<input class="form-control" type="text" name="password"  value="{{old('password')}}">
		@if($errors->has('password'))
			<span class="text-danger">
				<strong> {{$errors->first('password')}} </strong>
			</span>
		@endif <br>

		<label>Salary</label>
		<input class="form-control" type="text" name="sal"  value="{{old('sal')}}">
		@if($errors->has('sal'))
			<span class="text-danger">
				<strong> {{$errors->first('sal')}} </strong>
			</span>
		@endif 
		<br>

		<label>Designation</label>
		<input class="form-control" type="text" name="desig"  value="{{old('desig')}}">
		@if($errors->has('desig'))
			<span class="text-danger">
				<strong> {{$errors->first('desig')}} </strong>
			</span>
		@endif 
		<br>

		<label> Join Date </label>
		<input class="form-control" type="date" name="joinDate"  value="{{old('joinDate')}}">
		@if($errors->has('joinDate'))
			<span class="text-danger">
				<strong> {{$errors->first('joinDate')}} </strong>
			</span>
		@endif <br>

		<label>Upload Document</label>
		<input class="from-control" type="file" name="doc"><br>

		<input class= "btn1" type="Submit"  name="submit">
		<br>


	</form>
	
</fieldset>
</div>

	
@endsection