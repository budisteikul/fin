@inject('fin', 'budisteikul\fin\Classes\FinClass')
@extends('coresdk::layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profit &amp; Loss</div>
                <div class="card-body">
                
                
                
                
<table border="0" cellspacing="1" cellpadding="2" class="table table-borderless table-responsive" >
  <tbody>
    
    <tr class="table-active">
      <th colspan="3" class="font-weight-bolder">{{ $tahun }}</th>
      @for($i=1; $i<=12; $i++)
      <td align="center" class="font-weight-bolder">{{ Carbon\Carbon::createFromFormat('m', $i)->formatLocalized('%b') }}</td>
      @endfor
      <td align="center" class="font-weight-bolder"><i>Total YTD</i></td>
      <td align="center" class="font-weight-bolder">Growth Rate</td>
      <td align="center" class="font-weight-bolder">Projected</td>
    </tr>
    <tr>
      <td colspan="18" class="font-weight-bolder">
      <hr>
      Income
      <hr>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Revenue</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    @foreach($shoppingcarts as $shoppingcart)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $shoppingcart->booking_channel }}</td>
      @php
          $fin_categories_revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
            $fin_categories_revenue_per = $fin::total_shoppingcart_per_month($shoppingcart->booking_channel,$tahun,$i);
            $fin_categories_revenue_subtotal += $fin_categories_revenue_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{  number_format($fin_categories_revenue_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($fin_categories_revenue_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    @foreach($fin_categories_revenues as $fin_categories_revenue)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_revenue->name }}</td>
      @php
          $fin_categories_revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
          $fin_categories_revenue_per = $fin::total_per_month($fin_categories_revenue->id,$tahun,$i);
            $fin_categories_revenue_subtotal += $fin_categories_revenue_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{  number_format($fin_categories_revenue_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($fin_categories_revenue_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total Sales</td>
      @php
        $revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
            $revenue_per = $fin::total_all_channel_per_month($tahun,$i);
            $revenue_subtotal += $revenue_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{ number_format($revenue_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($revenue_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Cost of sales</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @foreach($fin_categories_cogs as $fin_categories_cog)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_cog->name }}</td>
      @php
          $fin_categories_cog_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
            $fin_categories_cog_per = $fin::total_per_month($fin_categories_cog->id,$tahun,$i);
            $fin_categories_cog_subtotal += $fin_categories_cog_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{ number_format($fin_categories_cog_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($fin_categories_cog_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total cost of sales</td>
      @php
        $cogs_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
          $cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
            $cogs_subtotal += $cogs_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{ number_format($cogs_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($cogs_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Gross Margin</td>
      <td>&nbsp;</td>
      @php
        $gross_margin_total = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      @php
      
        $revenue_per = $fin::total_all_channel_per_month($tahun,$i);
        $cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        $gross_margin = $revenue_per - $cogs_per;
        
        $gross_margin_total += $gross_margin;
        
        $gross_margin_print = number_format($gross_margin, 0, ',', '.');
        if($gross_margin<0) $gross_margin_print = '('. number_format($gross_margin*-1, 0, ',', '.') .')';
        
      @endphp
      <td align="right" class="font-weight-bolder" style="background-color:#FEFEEF">{{ $gross_margin_print }}</td>
      @endfor
      @php
        $gross_margin_total_print = number_format($gross_margin_total, 0, ',', '.');
        if($gross_margin_total<0) $gross_margin_total_print = '('. number_format($gross_margin_total*-1, 0, ',', '.') .')';
      @endphp
      <td align="right" class="font-weight-bolder"><i>{{ $gross_margin_total_print }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18" class="font-weight-bolder">
      <hr>
      Expenses
      <hr>
      </td>
    </tr>
     @foreach($fin_categories_expenses as $fin_categories_expense)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_expense->name }}</td>
      @php
          $fin_categories_expense_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
            $fin_categories_expense_per = $fin::total_per_month($fin_categories_expense->id,$tahun,$i);
            $fin_categories_expense_subtotal += $fin_categories_expense_per;
        @endphp
        <td align="right" style="background-color:#FEFEEF">{{ number_format($fin_categories_expense_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($fin_categories_expense_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach



    
   


    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total expenses</td>
      @php
        $expenses_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
        @php
            $expenses_per = $fin::total_expenses_per_month($tahun,$i);
            $expenses_subtotal += $expenses_per;
        @endphp
        <td align="right" class="font-weight-bolder" style="background-color:#FEFEEF">{{ number_format($expenses_per, 0, ',', '.') }}</td>
      @endfor
      <td align="right" class="font-weight-bolder"><i>{{ number_format($expenses_subtotal, 0, ',', '.') }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total Profit (Loss)</td>
      @php
        $profit_loss_total = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      @php
        $revenue_per = $fin::total_all_channel_per_month($tahun,$i);
        $cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        $gross_margin = $revenue_per - $cogs_per;
        
        $expenses_per = $fin::total_per_month_by_type('Expenses',$tahun,$i);
        $total_expenses = $expenses_per;
        
        $profit_loss = $gross_margin - $total_expenses;
        
        $profit_loss_total += $profit_loss;
        
        $profit_loss_print = number_format($profit_loss, 0, ',', '.');
        if($profit_loss<0) $profit_loss_print = '('. number_format($profit_loss*-1, 0, ',', '.') .')';
      @endphp
      <td align="right" class="font-weight-bolder" style="background-color:#FEFEEF">{{ $profit_loss_print }}</td>
      @endfor
      @php
        $profit_loss_total_print = number_format($profit_loss_total, 0, ',', '.');
        if($profit_loss_total<0) $profit_loss_total_print = '('. number_format($profit_loss_total*-1, 0, ',', '.') .')';
      @endphp
      <td align="right" class="font-weight-bolder"><i>{{ $profit_loss_total_print }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
  </tbody>
</table>



 </div>
            </div>
        </div>
    </div>
@endsection
