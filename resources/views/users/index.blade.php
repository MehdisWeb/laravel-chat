<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
                <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
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
              <li>
	              <a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Logout</a>
	          </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
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

        <h2 class="mb-4">Admins List</h2>
          <!-- data table start -->
          <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left"></h4>
                    <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="{{ route('users.create') }}">Create New Admin</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                    @include('layouts.partials.messages')

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Email</th>
                                    <th width="15%">Action</th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($users as $user)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    
                                    
                                    <td>
                                            <a class="btn btn-success text-white" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        
                                        <a class="btn btn-danger text-white" href="{{ route('users.destroy', $user->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                            Delete
                                        </a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        </form>

                                        <a class="btn btn-success text-white" href="{{ route('users.chat', $user->id) }}">chat</a>

                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div></div>
		</div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script>
  </body>
</html>