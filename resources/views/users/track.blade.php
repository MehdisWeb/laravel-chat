<html>
    <head>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        
    
    <section class="section">
        <div class="section-header">
            <h1 class="page__heading">Live Tracking</h1>
                            
                            <p id ="lfusers"> Filter users </p>
                             {{Form::select('drp_client',$users,null,['id'=>'filterUser','class'=>'form-select form-select-lg mb-3', 'placeholder' => 'All'])  }} 
                

                
                
               
                <!--
                <a href="#" class="btn btn-primary filter-container__btn mt-4 float-right" data-toggle="modal"
                   data-target="#AddModal">{{ __('messages.project.new_project') }} <i class="fas fa-plus"></i></a>-->
            </div>
        </div>
        <br>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           <!-- create map -->
                            <div class="row">
                                 <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-body">
                                             <div id="map" style="height: 650px;"></div>
                                        </div>
                                      </div>
                                 </div>
                            </div>
                            <!--
                            <div id="assignProjectUserModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('messages.project.edit_assignee') }}</h5>
                                            <button type="button" aria-label="Close" class="close outline-none"
                                                    data-dismiss="modal">×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['id'=>'editProjectAssign']) !!}
                                            <div class="alert alert-danger display-none"
                                                 id="editValidationErrorsBox"></div>
                                            <div class="row">
                                                <input type="text" hidden id="hdnProjectId">
                                                <div class="form-group col-sm-12">
                                                    {{ Form::label('assign_to', __('messages.task.assign_to').':') }}
                                                    {{ Form::select('projects[]',$users,null,['class' => 'form-control projectName','id'=>'editProjectUser', 'multiple' => true]) }}
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary ml-1', 'id' => 'btnSaveAssigneesProject', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                                                <button type="button" class="btn btn-light ml-1" data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <style>
        #filterUser{
            margin-left:30%;
            width:68%
        }
       .card-body{
        margin-left:8px;
        margin-right:8px;
       }
       .page__heading{
        font-size: 67px;
        margin-left: 36%;
        margin-top: 48px;
        margin-bottom: 65px;
       }

       #lfusers{
        margin-left: 300px;
        margin-bottom: -34px;
        font-size: 27px;
       }
    </style>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcFcIWMZijbqaWz_heQzSxXv5UJB2p0bo&callback=initMap&v=weekly"
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
            var constantine = {lat: 36.3570, lng: 6.6390};
            map = new google.maps.Map(document.getElementById('map'), {
                center: constantine,
                zoom: 8,
                mapTypeId: 'roadmap',
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
            });
            infoWindow = new google.maps.InfoWindow();


            //searchButton = document.getElementById("searchButton").onclick = searchLocations;
            /*
            //create marker
            var marker = new google.maps.Marker({
                map: map,
                position: constantine,
                draggable: true,
                animation: google.maps.Animation.DROP,
                title: 'Los Angeles'
            });
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);
            });
            google.maps.event.addListener(marker, 'dragend', function() {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                console.log(lat);
                console.log(lng);
            });*/
            getUsers("ALL");
        }

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
                            parseFloat(user.tracks[0].long),
                            parseFloat(user.tracks[0].lat));
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
            alert(selectedValue);
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
                            parseFloat(user.longitude),
                            parseFloat(user.latitude));
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

