<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
        <!-- link bootstrap -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


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

        <h2 class="mb-4">Live Tracking</h2>
          <!-- data table start -->
          <div class="col-12 mt-5">
             <div class="card">

                <div class="card-body">
                {{Form::select('drp_client',$users,null,['id'=>'filterUser','class'=>'form-select form-select-lg mb-3', 'placeholder' => 'All'])  }} 

                        <div id="map" style="height: 650px;"></div>
                </div>
             </div>
		</div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHLVXw1D1IWnldSu-F_wSX2ngtPSAZDPc&callback=initMap&v=weekly"
        async
        ></script>
    <script>
        // create map
        var map;
        var users_markers = [];
        var grossiste_markers = [];
        var pharmacie_markers = [];
        var medecin_markers = [];
        var infoWindow;
        var locationSelect;

        //init map
        function initMap() {
            var constantine = {lat: 32.24014138659281, lng: 35.23526067211441};
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat : 32.240162582874156, lng : 35.23539909299051},
                zoom: 19,
                mapTypeId: 'satellite',
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
            });

            const bounds = {
                17: [
                [20969, 20970],
                [50657, 50658],
                ],
                18: [
                [41939, 41940],
                [101315, 101317],
                ],
                19: [
                [83878, 83881],
                [202631, 202634],
                ],
                20: [
                [167757, 167763],
                [405263, 405269],
                ],
            };

              const imageMapType = new google.maps.ImageMapType({
                getTileUrl: function (coord, zoom) {
                    console.log(zoom)
                    if(zoom>=19){
                        //                        return "https://iili.io/HzmUV3X.png";

                        return "https://iili.io/HzmUV3X.md.png";
                    }
                if (
                    zoom < 17 ||
                    zoom > 20 ||
                    bounds[zoom][0][0] > coord.x ||
                    coord.x > bounds[zoom][0][1] ||
                    bounds[zoom][1][0] > coord.y ||
                    coord.y > bounds[zoom][1][1]
                ) {
                    return "";
                }
                return [
                    "https://www.gstatic.com/io2010maps/tiles/5/L2_",
                    zoom,
                    "_",
                    coord.x,
                    "_",
                    coord.y,
                    ".png",
                ].join("");
                },
                //tilesSize full size of the image
                //tilesSize full screen size
//                tileSize: new google.maps.Size(1366, 768),

                tileSize: new google.maps.Size(1366, 768),
            });
              map.overlayMapTypes.push(imageMapType);

            //infoWindow = new google.maps.InfoWindow();
            getUsers("ALL");
        }
        window.initMap = initMap;


        function getUsers(mID){
            //ajax request to get users livetracking and add marker for each one
            $.ajax({
                url: "/livetracking"+'/'+mID  ,
                type: "GET",
                success: function (data) {
                    //create marker in the map for each user
                    for (var i = 0; i < data.length; i++) {
                        var user = data[i];
                        if(Array.isArray(user.tracks) && user.tracks.length){
                            console.log(data)
                        var latlng = new google.maps.LatLng(
                            parseFloat(user.tracks[0].lat),
                            parseFloat(user.tracks[0].long));
                        var name = user.name;
                        var html = "<b>" + name + "</b> <br/>" + user.updated_at;
                        var marker = new google.maps.Marker({
                            map: map,
                            position: latlng
                        });
                        bindInfoWindow(marker, map, infoWindow, html);
                        users_markers.push(marker);
                    }
                }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        //create function bindInfoWindow
        function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }

        //jquery checkbox on change
        $(document).on('change', '#checkbox_user', function () {
            if ($(this).is(':checked')) {
                //enable grossiste input
                var selectedValue = $('#filterUser').val();
                beforeMethodUpdateMarkers(selectedValue,"users");
                $('#filterUser').prop('disabled', false);
            } else {
                $('#filterUser').prop('disabled', true);
                removeClienMarkers("users");
            }
        });

        $(document).on('change', '#filterUser', function () {
            var selectedValue = $('#filterUser').val();
            beforeMethodUpdateMarkers(selectedValue,"users");
        });


        $(document).on('change', '#checkbox_grossiste', function () {
            if ($(this).is(':checked')) {
                $('#filterGrossiste').prop('disabled', false);
                //get selected value
                var selectedValue = $('#filterGrossiste').val();
                beforeMethodUpdateMarkers(selectedValue,"grossiste");
            } else {
                $('#filterGrossiste').prop('disabled', true);
                removeClienMarkers("grossiste");
            }
        });

        $(document).on('change', '#filterGrossiste', function () {
            var selectedValue = $('#filterGrossiste').val();
            beforeMethodUpdateMarkers(selectedValue,"grossiste");
                
        });

        $(document).on('change', '#checkbox_pharmacie', function () {
            if ($(this).is(':checked')) {
                //enable grossiste input
                $('#filterPharmacie').prop('disabled', false);
                var selectedValue = $('#filterPharmacie').val();
                beforeMethodUpdateMarkers(selectedValue,"pharmacie");
            } else {
                $('#filterPharmacie').prop('disabled', true);
                removeClienMarkers("pharmacie");
            }
        });

        $(document).on('change', '#filterPharmacie', function () {
            var selectedValue = $('#filterPharmacie').val();
            beforeMethodUpdateMarkers(selectedValue,"pharmacie");
        });

        $(document).on('change', '#checkbox_medecin', function () {
            if ($(this).is(':checked')) {
                //enable grossiste input
                $('#filterMedecin').prop('disabled', false);
                var selectedValue = $('#filterMedecin').val();
                beforeMethodUpdateMarkers(selectedValue,"medecin");
            } else {
                $('#filterMedecin').prop('disabled', true);
                removeClienMarkers("medecin");
            }
        });

        $(document).on('change', '#filterMedecin', function () {
            var selectedValue = $('#filterMedecin').val();
            beforeMethodUpdateMarkers(selectedValue,"medecin");
        });


        function beforeMethodUpdateMarkers(selectedValue,type){
            console.log("type : "+type);
            if(type=="grossiste"){
                    removeClienMarkers("grossiste");
                    if(selectedValue==""){
                        updateClientMakers("grossiste");
                    }else{
                        updateClientMakers(selectedValue);
                    }
                    
                }else if(type=="pharmacie"){
                    removeClienMarkers("pharmacie");
                    if(selectedValue==""){
                        updateClientMakers("pharmacie");
                    }else{
                        updateClientMakers(selectedValue);
                    }
                }else if(type=="medecin"){
                    removeClienMarkers("medecin");
                    if(selectedValue==""){
                        updateClientMakers("medecin");
                    }else{
                        updateClientMakers(selectedValue);
                    }
                }else if(type=="users"){
                    removeClienMarkers("users");
                    if(selectedValue==""){
                        getUsers("ALL");
                    }else{
                        getUsers(selectedValue);
                    }
                }

                

        }


        function getMapIcons(department_id){
            if(department_id == 1){ //grossiste
                return 'http://maps.google.com/mapfiles/kml/pal5/icon54l.png';
            }else if(department_id == 2){ //pharmacie
                return 'http://maps.google.com/mapfiles/kml/pal5/icon47l.png';
            }else if(department_id == 3){ //medecin
                return 'http://maps.google.com/mapfiles/kml/pal5/icon44l.png';
            }
        }

        

        function updateClientMakers(client){
            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            //ajax request to get users livetracking and add marker for each one
            $.ajax({
                url: "/clientByID"+'/'+client  ,
                type: "GET",
                success: function (data) {
                    console.log(data);
                    //create marker in the map for each user
                    for (var i = 0; i < data.length; i++) {
                        var user = data[i];
                        var mIcon = getMapIcons(user.department_id);
                        var latlng = new google.maps.LatLng(
                            parseFloat(user.latitude),
                            parseFloat(user.longitude));
                        var name = user.name;
                        var html = "<b>" + name + "</b> <br/>" + user.updated_at;
                        var marker = new google.maps.Marker({
                            map: map,
                            position: latlng,
                            icon : mIcon
                        });
                        bindInfoWindow(marker, map, infoWindow, html);
                        if(user.department_id == 1){
                            grossiste_markers.push(marker);
                        }else if(user.department_id == 2){
                            pharmacie_markers.push(marker);
                        }else if(user.department_id == 3){
                            medecin_markers.push(marker);
                        }
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function removeClienMarkers(type){
            console.log("type remove : "+type);
            console.log("grossiste_markers : "+grossiste_markers.length);
            if(type == "grossiste"){
                for (var i = 0; i < grossiste_markers.length; i++ ) {
                    grossiste_markers[i].setMap(null);
                }
                grossiste_markers = [];
            }else if(type == "pharmacie"){
                for (var i = 0; i < pharmacie_markers.length; i++ ) {
                    pharmacie_markers[i].setMap(null);
                }
                pharmacie_markers = [];
            }else if(type == "medecin"){
                for (var i = 0; i < medecin_markers.length; i++ ) {
                    medecin_markers[i].setMap(null);
                }
                medecin_markers = [];
            }else if(type == "users"){
                for (var i = 0; i < users_markers.length; i++ ) {
                    users_markers[i].setMap(null);
                }
                users_markers = [];
            }

            
        }

        function updatePosition(){
            var selectedValue = $('#filterUser').val();
            removeClienMarkers('users')
                 if(selectedValue==""){
                        getUsers("ALL");
                    }else{
                        getUsers(selectedValue);
                    }

        }


        function runAutoUpdate(){
             
             timer = setInterval(function() {
                updatePosition();
             }, 15000);
            }

        runAutoUpdate()


    </script>
  </body>
</html>