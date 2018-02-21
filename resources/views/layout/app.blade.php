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
	@if(session('mode'))
		@if(session('mode') == "member")
		@include('layout.member')
		@elseif(session('mode') == "president")
		@include('layout.president')
		@elseif(session('mode') == "lobbyhead")
		@include('layout.lobbyhead')
		@elseif(session('mode') == "corecommittee")
		@include('layout.corecommittee')
		@endif
	@else
	@include('layout.member')
	@endif
<div class="right-column">
<nav class="navbar navbar-expand-lg navbar-light bg-white">
<button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Sidebar">
<span class="hamburger-box">
	<span class="hamburger-inner"></span>
</span>
</button>

<div class="navbar-collapse" id="navbar-header-content">
<ul class="navbar-nav navbar-language-translation mr-auto invisible" data-qp-animate-type="fadeInDown">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" id="navbar-dropdown-menu-link" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
			<i class="batch-icon batch-icon-book-alt-"></i>
			@if(session('mode'))
			@if(session('mode') == "member")
			Member
			@elseif(session('mode') == "president")
			President
			@elseif(session('mode') == "lobbyhead")
			Lobby Head
			@elseif(session('mode') == "corecommittee")
			Core Committee
			@endif
		@else
		Member
		@endif
		</a>
		<ul class="dropdown-menu" aria-labelledby="navbar-dropdown-menu-link">
			<li><a class="dropdown-item" href="{{ route('SwitchMode', 'member') }}">Member</a></li>
			<li><a class="dropdown-item" href="{{ route('SwitchMode', 'lobbyhead') }}">Lobby Head</a></li>
			<li><a class="dropdown-item" href="{{ route('SwitchMode', 'corecommittee') }}">Core Committee</a></li>
			<li><a class="dropdown-item" href="{{ route('SwitchMode', 'president') }}">President</a></li>

		</ul>
	</li>
</ul>
<ul class="navbar-nav navbar-notifications float-right invisible" data-qp-animate-type="fadeInDown">
	<li class="nav-item dropdown">
		<!--a class="nav-link dropdown-toggle" id="navbar-notification-search" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
			<i class="batch-icon batch-icon-search"></i>
		</a-->
		<!--ul class="dropdown-menu dropdown-menu-fullscreen" aria-labelledby="navbar-notification-search">
			<li>
				<form class="form-inline my-2 my-lg-0 no-waves-effect">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-primary btn-gradient waves-effect waves-light" type="button">Search</button>
						</span>
					</div>
				</form>
			</li>
		</ul-->
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-calendar" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
			<i class="batch-icon batch-icon-calendar"></i>
			<span class="notification-number">6</span>
		</a>
		<ul class="dropdown-menu dropdown-menu-right dropdown-menu-md" aria-labelledby="navbar-notification-calendar">
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Meeting with Project Manager</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">Right now</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Sales Call</h6>
						<div class="notification-text">
							Nibh amet cras sit libero
						</div>
						<span class="notification-time">One hour from now</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Email CEO new expansion proposal</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">In 3 days</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Team building exercise</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">In one week</span>
					</div>
				</a>
			</li>
		</ul>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-misc" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
			<i class="batch-icon batch-icon-bell"></i>
			<span class="notification-number">4</span>
		</a>
		<ul class="dropdown-menu dropdown-menu-right dropdown-menu-md" aria-labelledby="navbar-notification-misc">
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-bell batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">General Notification</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">Just now</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-cloud-download batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Your Download Is Ready</h6>
						<div class="notification-text">
							Nibh amet cras sit libero
						</div>
						<span class="notification-time">5 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">New Order</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">Yesterday</span>
					</div>
				</a>
			</li>
			<li class="media">
				<a href="task-list.html">
					<i class="batch-icon batch-icon-pull batch-icon-xl d-flex mr-3"></i>
					<div class="media-body">
						<h6 class="mt-0 mb-1 notification-heading">Pull Request</h6>
						<div class="notification-text">
							Cras sit amet nibh libero
						</div>
						<span class="notification-time">3 day ago</span>
					</div>
				</a>
			</li>
		</ul>
	</li>
</ul>
<ul class="navbar-nav ml-5 navbar-profile invisible" data-qp-animate-type="fadeInDown">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
			<div class="profile-name">
					
			</div>
			<div class="profile-picture bg-gradient bg-primary has-message float-right">
				<img src="" width="44" height="44">
			</div>
		</a>
		<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">
		<li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
			<li>
				<a class="dropdown-item" href="mail-inbox.html">
					Messages
					<span class="badge badge-danger badge-pill float-right">3</span>
				</a>
			</li>
			<li><a class="dropdown-item" href="profiles-member-profile.html">Settings</a></li>
			<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">Logout</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
			</form>
			</li>
		</ul>
	</li>
</ul>
</div>
</nav>
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
<script type="text/javascript" src="{{ asset('js/imagepick.js') }}"></script>
</body>
</html>