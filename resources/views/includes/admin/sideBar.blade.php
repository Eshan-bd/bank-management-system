<style type="text/css">

	#dashboard #admin{
		text-align: center;
		line-height: 40px;
		padding: 6px;
		text-transform: uppercase;
		background: #373b8b;
		color: White;
	}

	#dashboard {
	
	position: fixed;
	margin-top: -105px;
	width: 20%;
	height: 100%;
	text-align: left;
	float: left;
	background: #252525;
	border: 4px solid rgba(255, 255, 255, 0.1);
	
	}

	#dashboard a{
		color: white;

	}

	#dashboard a:hover{
		
		display: block;
		color:#a1a7d3;
	}

	#dashboard ul li{
		display: block;
		
		width: 100%;
		line-height: 60px;
		font-size: 18px;
		border-bottom: 1px solid rgba(255, 255, 255, .1);
		transition: 0.4s;

	}


	#dashboard ul li a{
		display: block;
		position: relative;

	}



	#dashboard ul li a:hover{
		padding-left: 40px;

	}


	#dashboard ul ul{
		position: static;
		display: none;
	}



	#dashboard ul ul li{
		line-height: 60px;
		border-bottom: none;
	}



	#dashboard ul ul li a{
		padding-left: 20px;

	}

	#dashboard ul li ul li a:hover{
		padding-left: 50px;
	}

	#dashboard ul ul li{
		line-height: 42px;
		border-bottom: none;
	}


	

	#dashboard ul li a span{
		position: absolute;
		right: 20px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 18px;
		transition: transform 0.4s;
	}

	#dashboard ul li a span.rotate{
		transform: translateY(-50%) rotate(-180deg);
	}

	#dashboard ul .feat-show.show{
		display: block;
	}

	#dashboard ul .user-show.show1{
		display: block;
	}

	#dashboard ul .req-show.show3{
		display: block;
	}
</style>



<br>
<br>
    	

<div class="col-md-1" id ='dashboard'>


	<h2 id="admin"> Admin Panel </h2>

	<ul>
        <li> <a href= "{{ route('AdminDashboard') }}"> <i class="fa fa-reorder"> Dashboard </i> </a> </li>
        <li> <a href= "{{ route('AdminProfile') }}"> <i class="fa fa-user-circle"> View Profile </i> </a> </li>
        <li> 
            <a herf="" class="feat-btn">
                <i class="fa fa-users"> Users <span class="fa fa-caret-down first"> </span> </i> 
            </a>
            <ul class="feat-show">
                <li>
                    <a href= "#" class="user-btn"> 
                        <i class="fa fa-user-plus"> Add Users <span class="fa fa-caret-down second"> 
                        </span> </i> 
                    </a> 
                    <ul class="user-show"> 
                        <li><a href="{{ route('RegAdmin') }}"><i class="fa fa-user-plus"> Admin </i></a></li>
                        <li><a href="{{ route('RegEmp') }}"><i class="fa fa-user-plus"> Employee </i></a></li>
                        <li><a href="{{ route('RegCustomer') }}"><i class="fa fa-user-plus"> Customer </i></a></li>
                    </ul>

                </li>

                <li> <a href= "{{ route('AccountAllList') }}"> <i class="fa fa-list"> All Users List </i> </a> </li>    
              
            </ul>
        <li> 
            <a href= "#" class="req-btn"> 
                <i class="fa fa-paper-plane"> Requests <span class="fa fa-caret-down third">
                </span></i> 
            </a>
            <ul class="req-show">
                <li> <a href= "{{ route('CustomerRequest') }}"> <i class="fa fa-users"> Account Request </i> </a> </li>
                <li> <a href= "{{ route('LoanRequest') }}"> <i class="fa fa-users"> Loan Request </i> </a> </li>
            </ul> 
        </li>
        
        <li> <a href= "{{route('AdminHistory')}}"><i class="fa fa-history"> History</i> </a> </li>
         <li> <a href= "{{route('NewsCreate')}}"><i class="fa fa-upload"> News</i> </a> </li>
    </ul>

    <script >

                $('.feat-btn').click( function(){
                $('#dashboard ul .feat-show').toggleClass("show");
                $('#dashboard ul .first').toggleClass("rotate");
            });

                $('.user-btn').click( function(){
                $('#dashboard ul .user-show').toggleClass("show1");
                $('#dashboard ul .second').toggleClass("rotate");
            });

            $('.req-btn').click( function(){
                $('#dashboard ul .req-show').toggleClass("show3");
                $('#dashboard ul .third').toggleClass("rotate");
            });

    </script>
	

</div>