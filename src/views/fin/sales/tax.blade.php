@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')



<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tax PP23</div>
                <div class="card-body">
                
                   
                   
                    


                    <div class="row w-100">
    <div class="col  text-left">
      {!! $fin::select_profitloss_form($tahun)  !!} 
    </div>
    <div class="col-auto text-right mr-0 pr-0">
        <a type="button" class="btn btn-secondary" href="/cms/fin/tax/pdf?year={{$tahun}}">
          <i class="far fa-file-pdf"></i> Export PDF
        </a>
    </div>        
</div>
                    


               
                    
                    
<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table mt-4" >
  <thead>
    <tr>
      <td width="10"><strong>No</strong></td>
      <td><strong>Bulan</strong></td>
      <td align="right"><strong>DPP</strong></td>
      <td align="right"><strong>PPH</strong></td>
    </tr>
  </thead>
  <tbody>
    
    @for($i=1;$i <= 12; $i++)
    <tr>
      <td align="center">{{$i}}</td>
      <td>{{$data->month_text[$i]}}</td>
      <td align="right">{{$data->revenue[$i]}}</td>
      <td align="right">{{$data->tax[$i]}}</td>
    </tr>
    @endfor
    
    
  </tbody>
</table>



 </div>
            </div>
        </div>
    </div>
@endsection
