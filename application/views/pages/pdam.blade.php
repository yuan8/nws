
@extends('template.lay1')

@section('content')

	<div class="row mb-4 mt-4">
		<div class="col-md-12 mb-4 mt-4">
			<div class="card text-dark mb-4 mt-4">
				<div class="card-body ">
						<table class="table">
							<thead>
								<tr>
									<th>Daerah</th>
									<th>Nilai Kinerja Total</th>
									<th>Nilai Aspek Keuangan</th>
									<th>Nilai Aspek Pelayanan</th>
									<th>Nilai Aspek Oprasional</th>


									<th>Detail</th>


								</tr>
							</thead>
							<tbody>
								@foreach($data as $d)
									<tr>
										<td>{{$d['nama']}}</td>
										<td>{{$d['nilai_kinerja_total']}}</td>
										<td>{{$d['nilai_aspek_keuangan']}}</td>
										<td>{{$d['nilai_aspek_pelayanan']}}</td>
										<td>{{$d['nilai_aspek_operasional']}}</td>
										<td><a href="{{rt('pdam/detail/').$d['id']}}" class="btn btn-primary">Detail</a></td>



									</tr>
								@endforeach
							</tbody>
						</table>

				</div>
			</div>

	</div>
	</div>

@stop