@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')



<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Balance Sheet</div>
                <div class="card-body">
                
                   
                   
                    


                    <div class="row w-100">
    <div class="col  text-left">
      {!! $fin::select_year_form($tahun)  !!} 
    </div>
    <div class="col-auto text-right mr-0 pr-0">
        <a type="button" class="btn btn-secondary" href="/cms/fin/neraca?year={{$tahun}}&action=pdf">
          <i class="far fa-file-pdf"></i> Export PDF
        </a>
        <a type="button" class="btn btn-secondary" href="/cms/fin/report/pdf/{{$tahun}}">
          <i class="far fa-file-pdf"></i> Export All PDF
        </a>
    </div>        
</div>
                    

<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-borderless table-responsive d-block d-md-table mt-4" >
  
  <tbody>
    <tr>
      <td valign="top"><strong>ASSETS</strong></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Cash</td>
      <td valign="top" align="right">{{number_format($kas, 0, ',', '.')}}<hr  class="s1" /></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><strong>TOTAL ASSETS</strong></td>
      <td valign="top">&nbsp;</td>
      <td valign="top" align="right">{{number_format($kas, 0, ',', '.')}}<hr  class="s9" /></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><strong>LIABILITIES</strong></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Debt</td>
      <td valign="top" align="right">0</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><strong>EQUITY</strong></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Capital</td>
      <td valign="top" align="right">{{number_format($modal, 0, ',', '.')}}</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Retained Earnings</td>
      <td valign="top" align="right">{{number_format($retained_earnings, 0, ',', '.')}}</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Earnings</td>
      <td valign="top" align="right">{{number_format($laba, 0, ',', '.')}}<hr class="s1" /></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><strong>TOTAL LIABILITIES AND EQUITY</strong></td>
      <td valign="top">&nbsp;</td>
      <td valign="top" align="right">{{number_format($modal+$laba+$retained_earnings, 0, ',', '.')}}<hr class="s9" /></td>
    </tr>

  </tbody>
  
</table>
               
<style type="text/css">
  
  .s9 {
    height:1px;
    border-top:1px solid ;
    border-bottom:1px solid ;
    background-color:white;
    margin:0 0 45px 0;
    max-width:600px;
  }
  .s1 {
    height:1px;
    background-color:white;
    margin:0 0 45px 0;
    max-width:600px;
    border-width:0;
    border-bottom:1px solid ;
  }
</style>                    
                    




 </div>
            </div>
        </div>
    </div>
@endsection
