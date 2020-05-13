<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/datatables.min.css"/>
    <link rel="stylesheet" href="{{asset("assets/css/owl.carousel.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/fa.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/dropzone.min.css")}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("assets/css/style.css?ver" . time())}}" />
    <link rel="stylesheet" href="{{asset("assets/css/responsive.css")}}" />

<!--  browser campatibel css files-->
<!--[if lt IE 9]>
<script src="{{asset('assets/js/html5shiv.js')}}"></script>
<script src="{{asset('assets/js/respond.min.js')}}"></script>
<![endif]-->

<title>@isset($page_title) {{$page_title}} @endisset</title>
