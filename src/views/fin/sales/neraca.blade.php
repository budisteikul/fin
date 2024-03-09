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
      {!! $fin::select_profitloss_form($tahun)  !!} 
    </div>
    <div class="col-auto text-right mr-0 pr-0">
        <a type="button" class="btn btn-secondary" href="/cms/fin/neraca?year={{$tahun}}&action=pdf">
          <i class="far fa-file-pdf"></i> Export PDF
        </a>
    </div>        
</div>
                    

<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-borderless table-responsive d-block d-md-table mt-4" >
  
  <tbody>
    <tr>
      <td><strong>Assets</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Cash</td>
      <td align="right">{{number_format($kas, 0, ',', '.')}}<hr /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Total Assets</strong></td>
      <td>&nbsp;</td>
      <td align="right">{{number_format($kas, 0, ',', '.')}}<hr /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Liabilities</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Debt</td>
      <td align="right">0</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Equity</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Capital</td>
      <td align="right">{{number_format($modal, 0, ',', '.')}}</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Earnings</td>
      <td align="right">{{number_format($laba, 0, ',', '.')}}<hr /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Total Liabilities dan Equity</strong></td>
      <td>&nbsp;</td>
      <td align="right">{{number_format($modal+$laba, 0, ',', '.')}}<hr /></td>
    </tr>

  </tbody>
  
</table>
               
                    
                    




 </div>
            </div>
        </div>
    </div>
@endsection
