@extends('Layouts.admin.admin')

@section('title')
{{'Edit Profile'}}
@endsection

@section('content')

<style type="text/css">
	
	.updatePro{

		height: 250px;
		width:380px;
        margin: 10px 585px;
        padding:50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px black;
       
	}

	.updatePro label{
		text-transform: uppercase;
		font-weight: bold;
	}

	.updatePro  input {
        display:block;
        width: 100%;
        border: 1px solid #000;
        padding:5px;
        box-sizing: border-box;
        border-radius: 10px;

      }

    .btn{

    	font-weight: bold;
	    text-transform: uppercase;
	    cursor: pointer;
	    background-color: #373b8b;
	    color: white;
	   	border-radius: 100px;

    }

    .btn:hover{

    	color: black;
    	background-color: white;

    }

</style>

<div class="updatePro">
	
<form action="/admin/editpicture/{{$user->id}}" method="post" enctype="multipart/form-data" >
		{{csrf_field()}}

		
			<label> Upload New Profile Picture </label>
			<br> <br>
			<input type="file" name="pic">

			<br>

			<input type="submit" class="btn" name="Upload" value="upload">
		
</form>

</div>

@endsection