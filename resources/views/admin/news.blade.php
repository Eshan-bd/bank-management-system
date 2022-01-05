@extends('layouts.admin.admin')

@section('title')
    {{'News'}}
@endsection

@section('content')

	<style type="text/css">

		
		.dashContent{
			margin-left: 310px;
		}

		.viewUsers{
			
			width:95%;
	        margin: 10px 10px;
	        padding:50px;
	        min-height: 60vh;
	        max-height: auto;
	        background: transparent;
	        border-radius: 10px;
	        box-shadow: 0px 0px 10px black;
	        margin-bottom: 50px;
		}

		

        .viewUsers .newsLabel{

			display:block;
	        font-weight: bold;
	        text-transform: uppercase;

		}

		.viewUsers .newsTitle{

			width: 35%;
		}

		.viewUsers .newsBody{

			display:block;
	        width: 100%;
	        border: 1px solid #000;
	        padding:5px;
	        box-sizing: border-box;
	        min-height: 40vh;
		}

		.viewUsers .btnSubmit{

			font-weight: bold;
		    text-transform: uppercase;
		    cursor: pointer;
		    background-color: #373b8b;
		    color: white;
		    border-radius: 2px;
		    width: 10%;
		    height: 35%;


		}

		.viewUsers .btnSubmit:hover{
			background-color: white;
			color: black;
		}

		
	</style>

<div class="dashContent">

	


	<div class="viewUsers">

		<form method="post" action="{{ route('NewsUpdate') }}" enctype="multipart/form-data">
		{{csrf_field()}}
		<label class="newsLabel"> News Title </label>
		<input type="text" name="newstitle" class="newsTitle">
		<br>
		@if($errors->has('newstitle'))
			<span class="text-danger">
				<strong> {{$errors->first('newstitle')}} </strong>
			</span>
		@endif 
		
		<br>

		<label class="newsLabel"> Upload News Image </label>
		<input type="file" name='pic'>

		<br>
		<br>

		<label class="newsLabel">Write news here:</label>
		<textarea name="newsBody" class="newsBody">
			
		</textarea>
		

		@if($errors->has('newsBody'))
			<span class="text-danger">
				<strong> {{$errors->first('newsBody')}} </strong>
			</span>
		@endif
		<br><br>

		<input class="btnSubmit" type="submit" name="submit" value="Submit">

		</form>

	</div>

</div>


@endsection