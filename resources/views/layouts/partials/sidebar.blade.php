 <!-- sidebar menu area start -->
 @php
     $usr = auth()->user()->role;
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo2.png') }}" al alt="">
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr == 'admin')
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>

                  
                    

                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Teachers
                        </span></a>
                        <ul class="collapse {{ Route::is('users.create') || Route::is('users.index') || Route::is('users.edit') || Route::is('users.show') ? 'in' : '' }}">
                                <li class="{{ Route::is('users.index')  || Route::is('users.edit') ? 'active' : '' }}"><a href="{{ route('users.index') }}">All Teachers</a></li>
                                <li class="{{ Route::is('users.create')  ? 'active' : '' }}"><a href="{{ route('users.create') }}">Create Teacher</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('users.track')}}"><i class="fa fa-map-marker"> </i><span> Track Teachers</span></a>
                    </li>
                    
                    @endif
                    <li>
                        <a href="{{route('users.profile')}}"><i class="fa fa-user"> </i><span> Profile</span></a>
                    </li>

                    @if ($usr == 'user')
                    <li>
                    <a href="{{route('chat')}}"><i class="fa fa-comments"> </i><span> Chat with Admin</span></a>
                    </li>
                    @endif


                    
              
                            </ul>
                        </li>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->