<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('img/favicon.png') }}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>IRS Batch 2007</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('fonts/batch-icons/css/batch-icons.css') }}">

<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/bootstrap/mdb.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/hamburgers/hamburgers.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/jvmaps/jqvmap.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/quillpro/quillpro.css') }}">

</head>
<body>
<div id="app" class="container-fluid">
<div class="row">

@yield('content')
</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('js/jquery/jquery-3.1.1.min.js') }}"></script>
<!-- Popper.js - Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap/mdb.min.js') }}"></script>
<!-- Velocity -->
<script type="text/javascript" src="{{ asset('plugins/velocity/velocity.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/velocity/velocity.ui.min.js') }}"></script>
<!-- Custom Scrollbar -->
<script type="text/javascript" src="{{ asset('plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- jQuery Visible -->
<script type="text/javascript" src="{{ asset('plugins/jquery_visible/jquery.visible.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="{{ asset('js/misc/ie10-viewport-bug-workaround.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/misc/holder.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.responsive.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>