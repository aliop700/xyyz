<html>
    <head>
        <title>
         Cars - @yield('title')
        </title>
        <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{asset('/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" media="all" />
        <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="{{asset('/css/font-awesome.css')}}" rel="stylesheet">
    </head>
    <body>
      @include('components.nav')
      @yield('content')
    </body>
</html>