<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>


	
	<title>@yield('title')</title>
</head>
<body style=" 
          background: url({{ asset('sysimages/back1.jpg') }}) no-repeat center center fixed;
          min-height: 100%; 
          background-position: center center;
          background-repeat: no-repeat;
          background-size: cover;">

	@include('includes.admin.nav')
	@include('includes.admin.sideBar')

	<div>
		@yield('content')
	</div>

</body>
</html>