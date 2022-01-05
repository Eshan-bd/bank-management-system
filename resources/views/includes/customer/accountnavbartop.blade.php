<style type="text/css">
    @import url("fonts.css");

    body {
        margin: 0;
        padding: 0;
        background-color:  #FAFAFA;
    }

    .flex-container-header {
        display: -webkit-flex;
        display: flex;
        width: auto;
        height: auto;
        background-color: #263238;
    }

    .flex-item-header {
        width: auto;
        height: 100px;
        margin: 10px;
    }

    h1 {
        font-family: OpenSans-Light;
        color: white;
        font-size: 3rem;
        line-height: 3rem;
        margin-top: calc((1.5rem - 2rem) + 2.5rem);
        margin-bottom: 1.5rem;
    }

    @media screen and (max-width: 855px) {
    h1 {
        font-size: 2.5rem;
        line-height: 2.5rem;
        margin-top: calc((1.5rem - 2rem) + 2rem);
        margin-bottom: 1.5rem;
    }
    }

    @media screen and (max-width: 510px) {
    h1 {
        font-size: 2rem;
        line-height: 2rem;
        margin-top: calc((1.5rem - 2rem) + 1.5rem);
        margin-bottom: 1.5rem;
    }
    }

    #navP{
        font-family: OpenSans-Light;
		color:white;
	}

	#navP:hover{
        font-family: OpenSans-Light;
		color:#a1a7d3;
    }
    
	#navA{
		color:white;
	}

	#navA:hover{
		color:#a1a7d3;
    }

    
	#navlogout{
		color: white;
	}

	#navlogout:hover{
		color:red;
    }

</style>

<div class="flex-container-header">
    <div class="flex-item-header">
        <img src="{{ asset('sysimages/logo.png') }}" onclick="" width="100" height="100">
    </div>
    <div class="flex-item-header">
        <h1><b>Castle Internet Bank</b></h1>
    </div>
</div>




<nav class="navbar" style=" text-transform: uppercase; background-color: #263238" >
	
	<div class="container-fluid" style="justify-content: end;">
		<ul class="nav justify-content-end" style="margin-right:auto; font-size:20px;">
            <li class="nav-item">
                <a class = "nav-link active"  href="#"><i class="fas fa-door-open" id="navA">&nbspWelcome {{ $user->firstname }} {{ $user->lastname }} </i></a>
            </li>
        </ul>
		<ul class="nav justify-content-end"  style="font-size:20px;">
		  <li class="nav-item">
            <a class = "nav-link active"  href="{{ route('account.profile') }}"><img src="/storage/account/profilepictures/{{ $user->userprofilepicture }}" style="max-height: 30px; max-width:30px; border:2px solid #263238; border-radius:20px;" id="navP"><strong id="navP">&nbspAccount Details</strong></a>
		  </li>

		  <li class="nav-item">
		  	<a class="nav-link" href="{{ route('all.logout') }}"><i class="fa fa-sign-out" id="navlogout">&nbspLog Out</i></a>
		  </li>
		</ul>
		
	</div>


</nav>