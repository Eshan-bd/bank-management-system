@extends('layouts.admin.admin')

@section('title')
    {{'Admin List'}}
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

		
		.viewUsers #tb{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 15px;
		    border-collapse: collapse;
			text-align: center;
			border: 2px solid #373b8b;
		}


		.viewUsers .#tb tr, th, td{
			
			
			border: 2px solid #063146;
			padding: 2px 2px;
			  
		}

		.viewUsers #tb th{
			background: #373b8b;
			text-transform: uppercase;
			column-width: 150px;
			justify-content: center;
			color: white
		}


		
	</style>

<div class="dashContent">

	<center>
		<h1 style="color: #2e4154; text-transform: uppercase;">Admin Lists</h1>
		
	</center>

	<div class="viewUsers">

	


		<table id="tb" class="table table-striped table-hover table-bordered border-dark" >
			<tbody>
			<tr>
				<th> Admin Id </th>
				<th>Admin Name</th>
				<th>Admin Picture</th>
				<th>Email</th>
				<th>Salary</th>
				<th>Actions</th>
			</tr>
		</tbody>

			@foreach($admin as $admin)
			@if($admin->id != session()->get('adminid'))
			<tr>
				<td>{{ $admin->id}}</td>
				<td>{{$admin->adminname}}</td>
				<td>
					<a href="{{url('storage/admin/admin_cover_images/'.$admin->userprofilepicture)}}">
						<img src="{{url('storage/admin/admin_cover_images/'.$admin->userprofilepicture)}}" 
					style="width: 30px; height: 30px;">
					</a>
					
				</td>
				<td>{{$admin->email}}</td>
				<td>{{$admin->adminsalary}}</td>
				
				<td>
					<a href="/admin/adminlist/edit/{{$admin->id}}"><img src=" {{ url('admin/admin_dashboard/edit (1).png') }}" style="width: 30px; height: 30px"></a>
					&nbsp &nbsp
					<a href="/admin/adminlist/delete/{{$admin->bank_user_id}}/{{$admin->id}}"><img src=" {{ url('admin/admin_dashboard/delete.png') }}" style="width: 30px; height: 30px"></a>

				</td>
				
			</tr>
			@endif
			@endforeach
			
		</table>

	</div>

</div>


@endsection