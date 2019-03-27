<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name='gegevensGet' id='gegevensGet' content={{ route('gegevensGet')}}>
	<meta name='gegevensPut' id='gegevensPut' content={{ route('gegevensPut')}}>
	<meta name='gegevensPost' id='gegevensPost' content={{ route('gegevensPost')}}>
	<meta name='gegevensDelete' id='gegevensDelete' content={{ route('gegevensDelete')}}>
	<meta name='gegevensPdf' id='gegevensPdf' content={{ route('gegevensPdf')}}>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel='stylesheet' href='css/app.css'>
</head>
<nav class="nav">
	@if(isset(Auth::user()->email))
		<span class="nav__item">
			Welkom {{Auth::user()->email}}
		</span>
		<a href='/KTapp/loggout' class="nav__item--loggout"></a>
	@else
		<script>window.location = "/KTapp";</script>
	@endif
</nav>
<body>
	<div class="crud" >
		
	</div>
	<script src='js/app.js'></script>
	<footer class="footer nav">
		<div class="credits">
			<span class="credits__text">Made by Rik Kampman</span>
		</div>
	</footer>
</body>
</html>
