
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



<style type="text/css">
	#navA a{
		color:white;
	}

	#navA a:hover{
		color:#a1a7d3;	
 
	}
	

	
</style>

<nav class="navbar" style=" text-transform: uppercase; background-color: #252525; " >
	
	<div class="container-fluid" style="justify-content: end;">
		
		<ul class="nav justify-content-end" id="navA">

		  <li class="nav-item">
		  	<a class = "nav-link"  href="{{route('AdminProfile')}}">{{Session()->get('adminName')}}</a>
		  </li>

		  <li class="nav-item">
		  	<a class="nav-link" href="{{route('all.logout')}}"> Logout </a>
		  </li>
		</ul>
		
	</div>


</nav>