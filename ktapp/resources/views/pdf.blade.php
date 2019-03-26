<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PDF</title>
</head>
<body style="margin: 0">
		<p style='margin-top: 25px; margin-left:25px;'>Week: {{$week}}</p>
		<br><? $i = 0;?>
	<table style='width:100vw'>
	@foreach ($default as $dag)
		@if($dag !== "gegevens_dag")
		@if($i === 2)<? $i = 0; ?></table><table style='width:100vw'>@endif<?$i++?>
			<td style='width:50vw;'>
				<table style='width:400px; table-layout: fixed;'>
					<thead>
					<tr style='border:1px solid black;'>
						<th>
							@if($dag['days_id'] === 1) Maandag
							@elseif ($dag['days_id'] === 2) Dinsdag
							@elseif ($dag['days_id'] === 3) Woensdag
							@elseif ($dag['days_id'] === 4) Donderdag
							@elseif ($dag['days_id'] === 5) Vrijdag
							@elseif ($dag['days_id'] === 6) Zaterdag
							@elseif ($dag['days_id'] === 7) Zondag
							@endif
						</th>
						<th style='white-space: nowrap;'>
							{{$dag['gegevens_datum']}}
						</th>
					</tr>
				</thead>
				<tr style='border:1px solid black;'>
						<th style='border:1px solid black;'>Km</th>
						<th style='border:1px solid black;'>Locatie</th>
						<th style='border:1px solid black;'>Aankomst</th>
						<th style='border:1px solid black;'>Vertrek</th>
						<th style='border:1px solid black;'>No</th>
					</tr>
					<tbody>
					@foreach ($gegevens as $items)
					@if($dag['days_id'] === $items['days_id'])
					<tr style='border:1px solid black;'>
							<td style='border:1px solid black;'>{{$items['gegevens_km']}}</td>
							<td style='border:1px solid black;'>{{$items['gegevens_locatie']}}</td>
							<td style='border:1px solid black;'>{{$items['gegevens_aankomst']}}</td>
							<td style='border:1px solid black;'>{{$items['gegevens_vertrek']}}</td>
							<td style='border:1px solid black;'>{{$items['gegevens_no']}}</td>
						</tr>
						@endif
						@endforeach
					</tbody>
					</table>
				</td>
				@endif
			@endforeach
		</body>
		</html>
		<style>
		@page { margin: 1px; }
		</style>