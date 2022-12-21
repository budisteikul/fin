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
                <div class="card-header">Remittance</div>
                <div class="card-body">

{!! $fin::select_profitloss_form($tahun)  !!}
<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table mt-4" >
  <thead>
    <tr>
      <td><strong>DATE</strong></td>
      @foreach($shoppingcart_payments as $shoppingcart_payment)
      <td><strong>{{ strtoupper($shoppingcart_payment->payment_provider) }} ({{ strtoupper($shoppingcart_payment->currency) }})</strong></td>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($date as $bulan)
    <tr>
      <td>{{ $bulan->tahun }} {{ $bulan->nama_bulan }}</td>
      @foreach($shoppingcart_payments as $shoppingcart_payment)
        @if($shoppingcart_payment->currency=="IDR")
          <td><strong>{{ $general_helper->numberFormat($fin->payment_total($bulan->tahun,$bulan->bulan,$shoppingcart_payment->payment_provider,$shoppingcart_payment->currency)) }}</strong></td>
        @else
          <td><strong>{{ $fin->payment_total($bulan->tahun,$bulan->bulan,$shoppingcart_payment->payment_provider,$shoppingcart_payment->currency) }}</strong></td>
        @endif
      @endforeach
    </tr>
    @endforeach
  </tbody>
</table>

</div>
            </div>
        </div>
    </div>
@endsection