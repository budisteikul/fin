@inject('fin', 'budisteikul\fin\Classes\FinClass')
@inject('general_helper', 'budisteikul\toursdk\Helpers\GeneralHelper')
@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">

</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Payment</div>
                <div class="card-body">

{!! $fin::select_profitloss_form($tahun)  !!}
<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table mt-4" >
  <thead>
    <tr>
      <td><strong>DATE</strong></td>
      @foreach($shoppingcart_payments as $shoppingcart_payment)
      <td align="right"><strong>{{ strtoupper($shoppingcart_payment->payment_provider) }} ({{ strtoupper($shoppingcart_payment->currency) }})</strong></td>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @php
        $total = [];
        $i = 0;
    @endphp
    @foreach($date as $bulan)
    <tr>
      <td>{{ $bulan->tahun }} {{ $bulan->nama_bulan }}</td>
      @php
        $j = 0;
      @endphp
      @foreach($shoppingcart_payments as $shoppingcart_payment)
        @php
            $amount = $fin->payment_total($bulan->tahun,$bulan->bulan,$shoppingcart_payment->payment_provider,$shoppingcart_payment->currency);
            $total[$i][$j] = $amount;
            $j++;
        @endphp
        
          <td align="right">{{ $general_helper->numberFormat($amount,'USD') }}</td>
        
      @endforeach
      @php
        $i++;
      @endphp
    </tr>
    @endforeach

    @php

      $total_payment = [];
      for($i=0; $i < count($total); $i++)
      {
         for($j=0; $j < count($total[$i]); $j++)
         {
            $total_payment[$j] = 0;
         }
      }

      for($i=0; $i < count($total); $i++)
      {
         for($j=0; $j < count($total[$i]); $j++)
         {
            $total_payment[$j] += $total[$i][$j];
         }
      }




    @endphp
    <tr>
      <td><strong>TOTAL</strong></td>
      @for($j=0; $j < count($total_payment); $j++)
        @php
          $amount = $total_payment[$j];
        @endphp
          <td align="right"><strong>{{ $general_helper->numberFormat($amount,'USD') }}</strong></td>
      @endfor
    </tr>
  </tbody>
</table>

</div>
            </div>
        </div>
    </div>
@endsection