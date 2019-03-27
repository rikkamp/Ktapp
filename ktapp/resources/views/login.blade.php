<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel='stylesheet' href='css/app.css'>
</head>
<body>

	<script src='js/app.js'></script>
	@if (Auth::viaRemember() || isset(Auth::user()->email))

		<script>window.location = '/KTapp/home'</script>

	@endif
	@if ($message = Session::get('error'))

		<div>
			{{$message}}
		</div>

	@endif

	@if (count($errors) > 0)

		@foreach($errors->all() as $error)
			{{ $error }}
		@endforeach

	@endif
	<nav class="nav">
	</nav>
		<div class="login">
			<form class="login__form" method="post" action={{url('/checklogin')}}>
				{{ csrf_field() }}
				<h2 class="login__title">Welkom bij de transport app</h2>
				<p class="login__text">Gebruikersnaam: </p><input class="login__input" type="email" name="email">
				<p class="login__text">Wachtwoord: </p><input class="login__input" type="password" name="password">
				<label class="login__text" for="remember_me"><input type="checkbox" name="remember_me" class="login__checkbox" id="remember">Remember Me</label>
				<input class="button--normal button" type="submit" name="login" value='login'>
			</form>
		</div>
		<footer class="footer nav">
			<div class="credits">
				<span class="credits__text">Made by Rik Kampman</span>
			</div>
		</footer>
</body>
</html>