@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')



<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Neraca</div>
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
                    


               
                    
                    
<table id="table1" border="0" cellspacing="1" cellpadding="2" class="table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table mt-4" >
  <thead>
    <tr>
      <td width="10" rowspan="2"><strong>No</strong></td>
      <td colspan="2"><strong>Aset</strong></td>
      <td align="left"><strong>Liabilitas</strong></td>
      <td align="left"><strong>Ekuitas</strong></td>
      <td align="center" rowspan="2"><strong>Keterangan</strong></td>
    </tr>
    <tr>
      
      <td><strong>Kas</strong></td>
      <td align="left"><strong></strong></td>
      <td align="left"><strong>Acc. Payable</strong></td>
      <td align="left"><strong>Modal</strong></td>
      
    </tr>
  </thead>

  <tbody>
    
    
    <tr>
      <td align="center">1</td>
      <td align="right">{{number_format($no1, 0, ',', '.')}}</td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right">{{number_format($no1, 0, ',', '.')}}</td>
      <td align="right"></td>
    </tr>
    <tr>
      <td align="center">2</td>
      <td align="right">{{number_format($no2, 0, ',', '.')}}</td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right">{{number_format($no2, 0, ',', '.')}}</td>
      <td align="left">Revenue</td>
    </tr>
    <tr>
      <td align="center">3</td>
      <td align="right">{{number_format($no3, 0, ',', '.')}}</td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right">{{number_format($no3, 0, ',', '.')}}</td>
      <td align="left">Cost of sales</td>
    </tr>
    <tr>
      <td align="center">4</td>
      <td align="right">{{number_format($no4, 0, ',', '.')}}</td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right">{{number_format($no4, 0, ',', '.')}}</td>
      <td align="left">Expenses</td>
    </tr>
    <tr>
      <td align="center"><strong>Saldo</strong></td>
      <td align="right">{{number_format($saldo, 0, ',', '.')}}</td>
      <td align="right">0</td>
      <td align="right">0</td>
      <td align="right">{{number_format($saldo, 0, ',', '.')}}</td>
      <td align="left"></td>
    </tr>
    <tr>
      <td align="center"></td>
      <td colspan="2" align="right"><strong>{{number_format($saldo, 0, ',', '.')}}</strong></td>
      <td colspan="2" align="right"><strong>{{number_format($saldo, 0, ',', '.')}}</strong></td>
      <td align="right"></td>
    </tr>
    
    
  </tbody>
</table>



 </div>
            </div>
        </div>
    </div>
@endsection
