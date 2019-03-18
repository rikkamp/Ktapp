<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PDF</title>
</head>
<body>
	{{$week}}
	@foreach ($default as $dag)
	<table>
		<tr>
			<th>
				{{$dag['GegevensDatum']}}
			</th>
			<th>
				{{$dag['GegevensDag']}}
			</th>
		</tr>
		<tr>
			<th>Km</th>
			<th>Locatie</th>
			<th>Aankomst</th>
			<th>Vertrek</th>
			<th>No</th>
		</tr>
		@foreach ($gegevens as $items)
			@if($dag['GegevensDag'] === $items['GegevensDag'])
				<tr>
					<td>{{$items['GegevensKm']}}</td>
					<td>{{$items['GegevensLocatie']}}</td>
					<td>{{$items['GegevensAankomst']}}</td>
					<td>{{$items['GegevensVertrek']}}</td>
					<td>{{$items['GegevensNo']}}</td>
				</tr>
			@endif
		@endforeach
	</table>
	@endforeach
</body>
</html>