<html lang="en">
<head>
	<meta charset="UTF-8">
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
	@else
		<script>window.location = "/main";</script>
		<p>hoi</p>
	@endif
</body>
</html>