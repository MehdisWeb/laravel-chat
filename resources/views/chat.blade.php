<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
        <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.partials.styles')
    @yield('styles')
    <link href="/css/app.css" rel="stylesheet">

<style>
    .chat {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .chat li {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
        margin: 0;
        margin-left:20px;
        color: #777777;
    }

    .panel-body {
        overflow-y: scroll;
        height: 350px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    
</style>
    <script>
   

        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
  
</script>
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

        <h2 class="mb-4">Live Chat</h2>
          <!-- data table start -->
          <div class="col-12 mt-5">
            <div id="app">
            <div class="container">
                <div class="row">
                    @include('layouts.partials.messages')
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading"> Chats </div>

                            <div class="panel-body">
                                <chat-messages :messages="messages" :user="{{ Auth::user() }}" :reciever ="{{$reciever}}" ></chat-messages>
                            </div>
                            <div class="panel-footer">
                                <chat-form
                                    v-on:messagesent="addMessage"
                                    :user="{{ Auth::user() }}"
                                    :reciever="{{$reciever}}"
                                ></chat-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .panel-body .clearfix{
                    margin-left:300px;
                }
            </style>
            </div>
        </div></div>
		</div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script src="/js/app.js"></script>
    <script>
    window.Laravel = {!! json_encode([
            'csrfToken'=> csrf_token(),
            'user'=> [
                'authenticated' => auth()->check(),
                'id' => auth()->check() ? auth()->user()->id : null,
                'name' => auth()->check() ? auth()->user()->name : null, 
                ]
            ])
        !!};
        </script>
  </body>
</html>