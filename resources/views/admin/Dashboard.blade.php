@extends('layouts.admin.admin')

@section('title')
    {{'Dashboard'}}
@endsection

@section('content')

	<style type="text/css">
		
		.dashContent{
			margin-left: 310px;
		}

		.Users{
		    padding: 2px 2px;
		    display: flex;
		    align-items: center;
		    justify-content: space-between;
		    flex-wrap: wrap;
		}

		.Users img{
		   width: 80px;
		   height: 80px;
		   align-items: center;
		}
		.Users .ad, .emp, .cus{
			
		    width: 250px;
		    height: 150px;
		    background: transparent;
		    display: flex;
		    align-items: center;
		    justify-content: space-around;
		    box-shadow: 0px 0px 10px black;
		    border-radius: 20px;
		    margin-right: 40px;
		    
		}

		
	</style>

<div class="dashContent">

	<div class="Users">	


		<a href="{{route('AdminList')}}" style="text-decoration:none; color: black;">
		<div class="ad">
		    
		   
		    <div class="box">
		        <h3>ADMINS</h3>
		        <h4>
		           <center>
		           	{{$admins->count()}}
		           </center>
		        </h4>
		    </div>

		    <div class="icon-case">
		        <img src=" {{ url('admin/admin_dashboard/administrator.png') }} ">
		    </div>
		  
		</div>
		</a>   

		<a href="{{route('EmpList')}}" style="text-decoration:none; color: black;">
		<div class="emp">
		    <div class="box">
		        <h3>EMPLOYEES</h3>
		        <h4>
		           <center>
		           	{{$employees->count()}}
		           </center>
		        </h4>
		    </div>

		    <div class="icon-case">
		        <img src=" {{ url('admin/admin_dashboard/employee.png') }} ">
		    </div>    
		</div>
		</a>

		<a href="{{route('CusList')}}" style="text-decoration:none; color: black;">
		<div class="cus">
		    <div class="box">
		        <h3>ACCOUNTS</h3>
		        <h4>
		           <center>
		           	
		           	{{$customerNumber}}
		           	
		           </center>
		        </h4>
		    </div>

		    <div class="icon-case">
		        <img src=" {{ url('admin/admin_dashboard/customer.png') }} ">
		    </div>    
		</div>

	</div>

</div>


@endsection