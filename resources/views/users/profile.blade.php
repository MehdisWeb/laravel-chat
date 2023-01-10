<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="{{ route('users.index') }}"><img src="{{ asset('assets/images/logo2.png') }}" alt="" width="200px" height="250px"></a>
	        <ul class="list-unstyled components mb-5">
              <li class="{{ Route::is('users.index')  ? 'active' : '' }}">
	              <a href="{{ route('users.index') }}">All Teachers</a>
	          </li>
              <li class="{{ Route::is('users.create')  ? 'active' : '' }}">
	              <a href="{{ route('users.create') }}">Create Teacher</a>
	          </li>
              <li class="{{ Route::is('users.track')  ? 'active' : '' }}">
	              <a href="{{route('users.track')}}">Track Teacher</a>
	          </li>
              <li class="{{ Route::is('users.profile')  ? 'active' : '' }}">
	              <a href="{{route('users.profile')}}">Profile</a>
	          </li>
	        </ul>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved Al-Quds Open University <i class="icon-heart" aria-hidden="true"></i> by Students Of <a href="https://www.qou.edu/" target="_blank">Qou.edu</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item {{ Route::is('users.index')  ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">All Teachers</a>
                </li>
                <li class="nav-item {{ Route::is('users.create')  ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.create') }}">Create Teacher</a>
                </li>
                <li class="nav-item {{ Route::is('users.track')  ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('users.track')}}">Track Teacher</a>
                </li>
                <li class="nav-item {{ Route::is('users.profile')  ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('users.profile')}}">Profile</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <h2 class="mb-4">Teacher Profile</h2>
          <!-- data table start -->
          <div class="col-12 mt-5">
          <div class="card">
                <div class="card-body">
                    <h4 class="header-title"></h4>
                    @include('layouts.partials.messages') 
                    <form action="{{ route('users.updateprofile') }}" method="POST">
                    {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">User Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                            </div>
                        </div>

                        

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Modifications</button>
                    </form>
                </div>
            </div>
		</div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
</html>