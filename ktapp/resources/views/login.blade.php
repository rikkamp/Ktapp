<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

	@if (Auth::viaRemember())

		<script>window.location = '/home'</script>

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

	<form method="post" action={{url('/main/checklogin')}}>
		{{ csrf_field() }}
		email<input type="email" name="email">
		pass<input type="password" name="password">
		<label for="remember_me"><input type="checkbox" name="remember_me" id="remember">Remember Me</label>
		<input type="submit" name="login" value='login'>
	</form>
</body>
</html>