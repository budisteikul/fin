@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Banking</div>
                <div class="card-body">
                
 @php
    $saldo = $fin::last_month_saldo($tahun,$bulan);
 @endphp               
                
<table border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table" >
  <tbody>
    <tr class="table-active">
      <td><strong>Saldo Awal : {{number_format($saldo, 0, ',', '.')}}</strong></td>
    </tr>
  </tbody>
</table>

<table border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table" >
  <tbody>
    <tr class="table-active">
      <td width="20%"><strong>Date</strong></td>
      <td><strong>Revenue</strong></td>
      <td><strong>Cogs</strong></td>
      <td><strong>Expenses</strong></td>
      <td><strong>Tax</strong></td>
      <td><strong>Saldo</strong></td>
    </tr>
    @php
    $total_revenue = 0;
    $total_cogs = 0;
    $total_expenses = 0;
    $total_tax = 0;
    @endphp
    @for($i=1;$i <= date("t",strtotime($tahun."-".$bulan."-01"));$i++)
    @php
      $total_revenue_per_day = $fin::total_all_channel_per_day($tahun,$bulan,$i);
      $total_revenue += $total_revenue_per_day;

      $total_cogs_per_day = $fin::total_per_day_by_type('Cost of Goods Sold',$tahun,$bulan,$i);
      $total_cogs += $total_cogs_per_day;

      $total_expenses_per_day = $fin::total_per_day_by_type('Expenses',$tahun,$bulan,$i);
      $total_expenses += $total_expenses_per_day;

      $total_tax_per_day = $total_revenue_per_day * 0.5 / 100;
      $total_tax += $total_tax_per_day;

      $saldo += $total_revenue_per_day;
      $saldo -= $total_cogs_per_day;
      $saldo -= $total_expenses_per_day;
      $saldo -= $total_tax_per_day;
    @endphp
    <tr>
      <td>{{$i}} {{ date('F', mktime(0, 0, 0, $bulan, 10)); }} {{$tahun}}</td>
      <td>{{number_format($total_revenue_per_day, 0, ',', '.')}}</td>
      <td>{{number_format($total_cogs_per_day, 0, ',', '.')}}</td>
      <td>{{number_format($total_expenses_per_day, 0, ',', '.')}}</td>
      <td>{{number_format($total_tax_per_day, 0, ',', '.')}}</td>
      <td>{{number_format($saldo, 0, ',', '.')}}</td>
    </tr>
    @endfor
    <tr>
      <td><strong>Total</strong></td>
      <td><strong>{{number_format($total_revenue, 0, ',', '.')}}</strong></td>
      <td><strong>{{number_format($total_cogs, 0, ',', '.')}}</strong></td>
      <td><strong>{{number_format($total_expenses, 0, ',', '.')}}</strong></td>
      <td><strong>{{number_format($total_tax, 0, ',', '.')}}</strong></td>
      <td><strong></strong></td>
    </tr>
  </tbody>
</table>

<table border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table" >
  <tbody>
    <tr class="table-active">
      <td><strong>Saldo Akhir : {{number_format($saldo, 0, ',', '.')}}</strong></td>
    </tr>
  </tbody>
</table>

 </div>
            </div>
        </div>
    </div>
@endsection
