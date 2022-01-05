@extends('layouts.admin.admin')

@section('title')
    {{'Customer Requests'}}
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
		<h1 style="color: #2e4154; text-transform: uppercase;">Account Requests</h1>
	</center>

	<div class="viewUsers">
		
		<table id="tb" class="table table-striped table-hover table-bordered border-dark" >
			<tbody>
			<tr>
				
				<th>Account Name</th>
				<th>Profile Picture</th>
				<th>Account Type</th>
				<th>Account document</th>
				<th>Balance</th>

				<th>Interest Rate</th>
				<th>State</th>
				<th>Actions</th>
			</tr>
		</tbody>

			@foreach($cus as $customer)
			@if($customer->accountstate == 'INACTIVE')
			
			<tr>
				<td>{{$customer->accountname}}</td>
				<td>
					<a href="{{url('storage/account/profilepictures/'.$customer->userprofilepicture)}}">
						<img src="{{url('storage/account/profilepictures/'.$customer->userprofilepicture)}}" 
					style="width: 30px; height: 30px;">
					</a>
				</td>
				<td>{{$customer->accounttype}}</td>
				<td>
					<a href="{{url('storage/account/accountdocuments/'.$customer->accountdocument)}}">
						<img src="{{url('storage/account/accountdocuments/'.$customer->accountdocument)}}" 
					style="width: 30px; height: 30px;">
					</a>
				</td>
				<td>{{$customer->accountbalance}}</td>
				<td>{{$customer->accountinterestrate}}</td>
				
				<td><b style="color:green;">{{$customer->accountstate}}</b></td>
				<td>
					<a href="/admin/customer/requests/{{$customer->id}}"><img src=" {{ url('admin/customer_request/check-mark.png') }}" style="width: 30px; height: 30px"></a>
					&nbsp &nbsp
					<a href="/admin/customer/requests/{{$customer->bank_user_id}}/{{$customer->id}}"><img src=" {{ url('admin/customer_request/denied.png') }}" style="width: 40px; height: 40px"></a>

				</td>
				
			</tr>

			@endif
			@endforeach
			
		</table>

	</div>

</div>


@endsection