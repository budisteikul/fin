@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">
$(function() {
    $('#table1').appendTo('#table2');
});
</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Banking</div>
                <div class="card-body">
                
 @php
    $saldo_awal = $fin::last_month_saldo($tahun,$bulan);
    $saldo = $saldo_awal;

    
 @endphp               
                
{!! $fin::select_banking_form($tahun,$bulan)  !!}

<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table" >
  <tbody>
    <tr class="table-active">
      <td width="20%"><strong>Date</strong></td>
      <td><strong>Debit</strong></td>
      <td><strong>Credit</strong></td>
      <td><strong>Balance</strong></td>
    </tr>
    @php
    

    $total_debit = 0;
    $total_credit = 0;

    @endphp
    @for($i=1;$i <= date("t",strtotime($tahun."-".$bulan."-01"));$i++)
    @php

      $date1 = \Carbon\Carbon::parse($tahun."-".$bulan."-".$i);
      if($date1->isPast())
      {

      $total_revenue_per_day = $fin::total_all_channel_per_day($tahun,$bulan,$i);
      

      $total_cogs_per_day = $fin::total_per_day_by_type('Cost of Goods Sold',$tahun,$bulan,$i);
      

      $total_expenses_per_day = $fin::total_per_day_by_type('Expenses',$tahun,$bulan,$i);
      

      $total_tax_per_day = $total_revenue_per_day * 0.5 / 100;
      

      $saldo += $total_revenue_per_day;
      $saldo -= $total_cogs_per_day;
      $saldo -= $total_expenses_per_day;
      $saldo -= $total_tax_per_day;

      $debit = $total_revenue_per_day;
      $total_debit += $debit;

      $credit = $total_cogs_per_day + $total_expenses_per_day + $total_tax_per_day;
      $total_credit += $credit;

      
    @endphp
    <tr>
      <td>{{$i}} {{ date('F', mktime(0, 0, 0, $bulan, 10)); }} {{$tahun}}</td>
      <td>{{number_format($debit, 0, ',', '.')}}</td>
      <td>{{number_format($credit, 0, ',', '.')}}</td>
      <td>{{number_format($saldo, 0, ',', '.')}}</td>
    </tr>
    @php
      }
    @endphp
    @endfor
    
  </tbody>
</table>

<table id="table2" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-responsive w-100 d-block d-md-table" >
  <tbody>
    <tr class="table-active">
      <td><strong>Recapitulation</strong></td>
    </tr>
    <tr>
      <td>Beginning balance : {{number_format($saldo_awal, 0, ',', '.')}}</td>
    </tr>
    <tr>
      <td>Debit : {{number_format($total_debit, 0, ',', '.')}}</td>
    </tr>
    <tr>
      <td>Credit : {{number_format($total_credit, 0, ',', '.')}}</td>
    </tr>
    <tr>
      <td>Profit/Loss : {{number_format($total_debit - $total_credit, 0, ',', '.')}}</td>
    </tr>
    <tr>
      <td>Ending balance : {{number_format($saldo, 0, ',', '.')}}</td>
    </tr>
  </tbody>
</table>

 </div>
            </div>
        </div>
    </div>
@endsection
