@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Revenue</div>
                <div class="card-body">
                
                
                
                
<table border="0" cellspacing="1" cellpadding="2" class="table table-borderless table-responsive" >
  <tbody>
    <tr class="table-active">
      <td>Date</td>
      <td>Total</td>
    </tr>
    @php
    $total = 0;
    @endphp
    @for($i=1;$i <= date("t",strtotime($tahun."-".$bulan."-01"));$i++)
    @php
      $total_per_day = $fin::total_all_channel_per_day($tahun,$bulan,$i);
      $total += $total_per_day;
    @endphp
    <tr>
      <td>{{$i}} {{ date('F', mktime(0, 0, 0, $bulan, 10)); }} {{$tahun}}</td>
      <td>{{number_format($total_per_day, 0, ',', '.')}}</td>
    </tr>
    @endfor
    <tr>
      <td><strong>Total</strong></td>
      <td><strong>{{number_format($total, 0, ',', '.')}}</strong></td>
    </tr>
  </tbody>
</table>



 </div>
            </div>
        </div>
    </div>
@endsection
