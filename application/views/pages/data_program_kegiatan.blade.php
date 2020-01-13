@extends('template.lay1')

@section('content')


<div class="row mt-4 mb-4" style="padding-top: 25px;">
	<div class="col-md-12 ">
	<div class="card ">
	<div class="card-body table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Kegiatan</th>
				<th>Anggaran</th>
				<th>NSPK</th>
				<th>SPM</th>
				<th>PN</th>
				<th>SDGS</th>
				<th>Indikator</th>
				<th>Target Awal</th>
				<th>Target Ahir</th>
				<th>Program</th>
				<th>Sub Urusan</th>
				<th>Urusan</th>
				<th>Daerah</th>

			</tr>
		</thead>
		<tbody>
			<?php  $i=0;?>
			@foreach($datas as $key=> $data)
				<tr>
					<td>
						{{($i+1)}}
					</td>
					<td>{{$data['nama']}}</td>
					<td>Rp. {{number_format($data['anggaran'],0,',','.')}}</td>
					<td>{!! $data['nspk'] !!}</td>
					<td>{!! $data['spm'] !!}</td>
					<td>{!! $data['pn'] !!}</td>
					<td>{!! $data['sdgs'] !!}</td>
					<td></td>
					<td></td>
					<td></td>
					<td>{{$data['program']}}</td>
					<td>{{$data['sub_urusan']}}</td>
					<td>{{$data['urusan']}}</td>
					<td>{{$data['daerah']}}</td>


				</tr>
				@if(isset($data['indikator']))
					@foreach($data['indikator'] as $indi)
					<tr>
						<td colspan="7"></td>
						<td>{{$indi['nama']}}</td>
						<td>{{$indi['target_awal']}} </td>
						<td>{{$indi['target_ahir']}} </td>

						<td colspan="4"></td>


					</tr>

				@endforeach

				@endif


				<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
</div>

</div>
</div>
</div>

@stop