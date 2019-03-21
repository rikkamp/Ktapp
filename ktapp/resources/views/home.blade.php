<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name='id' content=@if(isset(Auth::user()->id)) {{Auth::user()->id}}@endif>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	hallo
	@if(isset(Auth::user()->email))
		<div>
			ghallo {{Auth::user()->email}}
		</div>
		<a href='/loggout'>loguit</a>
	@else
		<script>window.location = "/main";</script>
		<p>hoi</p>
	@endif
	<div class="crud" >

	</div>
	<script src='js/app.js'></script>
</body>
</html>
