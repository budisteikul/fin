@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')


@php
    $saldo_awal = $fin::calculate_saldo($tahun,$bulan);
    $saldo = $saldo_awal;
@endphp 
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Report Guide</div>
                <div class="card-body">
                
                    <div class="row w-100">
                    <div class="col text-left">
                    {!! $fin::select_yearmonth_form($tahun,$bulan)  !!}
                    </div>
                    </div>


  <div class="row">
    <div class="col-sm-auto">
      
<div class="card text-white bg-primary mb-3" style="width: 23rem;">
  <div class="card-header">{{ $fin->nameCategory(12,'-') }}</div>
  <div class="card-body">
    <h5 class="card-title">Total : IDR {{ number_format($fin->total_per_month(12,$tahun,$bulan), 0, ',', '.') }}</h5>
    <h5 class="card-title">Jalan : {{ number_format($fin->count_per_month(12,$tahun,$bulan), 0, ',', '.') }} kali</h5>
  </div>
</div>

    </div>
    <div class="col-sm-auto">
     
<div class="card text-white bg-success mb-3" style="width: 23rem;">
  <div class="card-header bg-success">{{ $fin->nameCategory(13,'-') }}</div>
  <div class="card-body">
    <h5 class="card-title">Total : IDR {{ number_format($fin->total_per_month(13,$tahun,$bulan), 0, ',', '.') }}</h5>
    <h5 class="card-title">Jalan : {{ number_format($fin->count_per_month(13,$tahun,$bulan), 0, ',', '.') }} kali</h5>
  </div>
</div>

    </div>
  </div>









                </div>
            </div>
        </div>
</div>
@endsection
