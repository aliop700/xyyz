<html>
    <div id="loadOverlay" style=" position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
      <img style=" width: 100px; position:absolute; top:50%; left:50%; transform:translate(-50% , -50%); z-index:2000;" src="/images/loading.gif"/>
    </div>

    <head>
        <title>
         Autorepairskit - @yield('title')
        </title>
        <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
        
        @if( auth()->user() &&  auth()->user()->isAdmin())
          <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" media="all" />
        @endif

        @if (App::getLocale() == 'en')
        <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
        @else
        <link href="{{asset('/css/style_rtl.css')}}" rel="stylesheet" type="text/css" media="all" />
        @endif
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="{{asset('/css/font-awesome.css')}}" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#0d9feb">
        <meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png">
        <meta name="theme-color" content="#0d9feb">
    </head>

    <script>
      let lang ="{{App::getLocale()}}"
    </script>
    <body>
      <script src="/js/jquery.min.js"></script>
      <nav> @include('components.nav')</nav>
      <section class="main-content"> @yield('content')</section>
      <footer>
        @if( auth()->user() &&  auth()->user()->isAdmin())
        <script src="/js/bootstrap3.4.1.min.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
        <script src="/js/dataTables.bootstrap4.min.js"></script>
        @include('components.admin_footer')
        @elseif (\Route::current()->getName() != 'loginPage' && \Route::current()->getName() != 'regPage')
          @include('components.footer')
        @endif
      </footer>
      <script src="/js/sweet-alert.min.js"></script> 
    </body>
</html>