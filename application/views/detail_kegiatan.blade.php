@extends('template.lay1')

@section('content')
<div class="card">
  <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode Kegiatan</th>
            <th>NSPK</th>
            <th>SPM</th>
            <th>PN</th>
            <th>SDGS</th>

            <th>Kegiatan</th>
            <th>indikator</th>
            <th>target awal</th>
            <th>target ahir</th>

          </tr>
        </thead>
        <tbody>
          <?php $num=0; ?>
          @foreach($data as $key=> $d)
          <?php

          $num+=1;
          ?>
          <tr>
              <td>{{$num }}</td>
              <td>
                {{$key}}
              </td>
              <td>
                {!!$d['nspk']!!}
              </td>
              <td>
                {!!$d['spm']!!}

              </td>
              <td>
                {!!$d['pn']!!}

              </td>
              <td>
                {!!$d['sdgs']!!}

              </td>
              <td>
                <p class="text-primary">{{$d['nama']}}</p>
              </td>
              <td>
              </td>
              <td></td>
              <td></td>

          </tr>
          @if(isset($d['indikator']))
            @foreach($d['indikator'] as $ind)
              <tr>
                <td></td>
                <td></td>

                <td></td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>{{$ind['nama']}}</td>
                <td>{{$ind['target_awal']}}</td>
                <td>{{$ind['target_ahir']}}</td>

              </tr>
            @endforeach
          @endif

          @endforeach


      </table>

  </div>

</div>

@stop
