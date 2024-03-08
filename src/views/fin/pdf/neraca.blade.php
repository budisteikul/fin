@inject('fin', 'budisteikul\fin\Classes\FinClass')
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">   
<title></title>
<style type="text/css">
  
  .font-weight-bolder
  {
    font-weight: bold;
  }
  body {
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px; 
}
hr
{
  border: 1px thin black;
}
.container {
  display: table;
  width: 100%;
  height: 100%;
}

.content {
  display: table-cell;
  text-align: center;
  vertical-align: middle;
}
table{
  width: 100%;
}
</style>
</head>
<body>
 

<div>
<div style="margin-top: 30px; margin-bottom: 40px; font-weight: bold; text-align: center;">
  Neraca {{env('APP_NAME')}} Tahun {{$tahun}}
</div>

<center>

  <table id="table1" border="1" cellspacing="2" cellpadding="3" style="border-collapse: collapse; " >
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

 </center>    

</div>






</body>
</html>
