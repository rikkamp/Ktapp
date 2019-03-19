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
		@if($dag !== "gegevens_dag")
			<table>
				<tr>
					<th>
						{{$dag['gegevens_datum']}}
					</th>
					<th>
						{{$dag['gegevens_dag']}}
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
				@if($dag['gegevens_dag'] === $items['gegevens_dag'])
				<tr>
						<td>{{$items['gegevens_km']}}</td>
						<td>{{$items['gegevens_locatie']}}</td>
						<td>{{$items['gegevens_aankomst']}}</td>
						<td>{{$items['gegevens_vertrek']}}</td>
						<td>{{$items['gegevens_no']}}</td>
					</tr>
					@endif
					@endforeach
				</table>
				@endif
			@endforeach
		</body>
		</html>