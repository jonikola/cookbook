	<!DOCTYPE html>
	<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Kuvar</title>

		@yield ('styles')

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}">
		<link rel="stylesheet" href="{{ asset('css/nivo_themes/default/default.css') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	</head>
	<body>
		
		<section class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						@foreach ($categories as $cat)
							<li><a href="{{ route('category', $cat) }}" class="smoothscroll">{{ strtoupper($cat->name) }}</a></li>
						@endforeach
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/" class="smoothscroll glyphicon glyphicon-home"></a></li>
						<li><a href="#" class="smoothscroll glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" role="button"></a></li>
						
						<li class="dropdown" id="myDropdown">
							<a id="list-btn" class="smoothscroll dropdown-toggle glyphicon glyphicon-list" role="button" aria-haspopup="true" aria-expanded="false"></a>
							<ul class="dropdown-menu">
								<p align="center" class="empty">Lista je prazna</p>
								<li role="separator" class="divider"></li>
								<li>
									<center><div class="btn-group" role="group" aria-label="...">
  										<button id="print-recipe-list" type="button" class="btn btn-default list-btn" disabled="true">Recepti</button>
  										<button id="print-ing-list" type="button" class="btn btn-default list-btn" disabled="true">Spisak</button>
									</div></center>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Dodaj novi recept</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								@include ('recipes.create')
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		@yield ('content')

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		@yield ('scripts')
		<script src="{{ asset('js/jquery.autocomplete.js') }}"></script>
		<script src="{{ asset('js/home.js') }}"></script>
	</body>
	</html>