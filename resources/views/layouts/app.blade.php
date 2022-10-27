<!doctype html>
<html class="no-js" lang="en">

<head>
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

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    
    <!-- preloader area end -->
    <!-- page container area start -->

    <div class="page-container">

       @include('layouts.partials.sidebar')

        <!-- main content area start -->

        <div  class="main-content">
            @include('layouts.partials.header')
            
            <div id="app">
            @yield('content')
            </div>

        </div>
        <!-- main content area end -->
        @include('layouts.partials.footer')
    </div>
    <!-- page container area end -->
    @include('layouts.partials.offsets')
    @include('layouts.partials.scripts')
    

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
