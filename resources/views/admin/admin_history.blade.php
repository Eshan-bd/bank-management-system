@extends('layouts.admin.admin')

@section('title')
    {{'History'}}
@endsection

@section('content')

	<style type="text/css">

		
		.dashContent{
			margin-left: 310px;
		}

		.history{
			
		width:95%;
        margin: 10px 10px;
        padding:50px;
        background: transparent;
        border-radius: 10px;
        box-shadow: 0px 0px 10px black;
        margin-bottom: 50px;
		}

		
		.history #tb{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 15px;
		    border-collapse: collapse;
			text-align: center;
			border: 2px solid #373b8b;
		}


		.history #tb tr, th, td{
			
			
			border: 2px solid #063146;
			padding: 2px 2px;
			  
		}

		.history #tb th{
			background: #373b8b;
			text-transform: uppercase;
			
			justify-content: center;
			color: white
		}
		.searchDiv{
			width: 300px;
			background-color: white;
			border-radius: 100px;
			border-color: blue;
			box-shadow: 0px 0px 5px black;
			
		}
		.searchDiv #search{

			width: 250px;
			border-radius: 100px;
			border: none;
			outline: none;

		}

		.PDFDownload{

			margin-left: 870px;
		}
		
		
	</style>

<div class="dashContent">
	
	<center>
		<h1 style="color: #2e4154; text-transform: uppercase;">Transaction History</h1>
		<br>
	</center>
		

	<div class="history">
		
		<form method="get">
			<center>
				<div class = "searchDiv">
					<i class="fa fa-search"> </i>
					<input id="search" type="text" autocomplete="off" name="search" placeholder="SEARCH ACCOUNT ID.." >

				</div>
			</center>
		</form>
		
		
		<br>
	
		<a class="PDFDownload" href="{{route('DownloadPdf')}}"><i class="fa fa-download" aria-hidden="true"></i></a>
		<table id="tb" class="table table-striped table-hover table-bordered border-dark" >
		<tbody>
			<tr>
				
				<th>History Id</th>
				<th>History Date</th>
				<th>Transction Id</th>
				<th>Remarks</th>
				<th>Debit</th>
				<th>Credits</th>
				<th>Transaction Time</th>

			</tr>
		</tbody>

			@foreach($history as $history)
			
			<tr>
				<td>{{$history->id}}</td>
				<td>{{$history->historydate}}</td>
				<td>{{$history->account_id}}</td>
				<td>{{$history->remarks}}</td>
				<td>{{$history->debit}}</td>
				<td>{{$history->credit}}</td>
				
				<td>{{$history->created_at}}</td>
			</tr>

			@endforeach

			
                    <tr>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Total</th>
                        <td>{{$debit}}</td>
                        <td>{{$credit}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Balance</th>
                        <td></td>
                        <td>{{$balance}}</td>
                        <td></td>
                    </tr>
			
		</table>

	</div>

</div>


@endsection