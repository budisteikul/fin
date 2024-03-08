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
  Balance Sheet {{env('APP_NAME')}} Year {{$tahun}}
</div>

<center>





  <table id="table1" border="0" cellspacing="2" cellpadding="3" style="border-collapse: collapse; " >
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

 </center>    

</div>






</body>
</html>
