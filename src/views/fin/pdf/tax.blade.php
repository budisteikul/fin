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
  List Pembayaran PP23 {{env('APP_NAME')}} Tahun {{$tahun}}
</div>

<center>
 <table id="table1" border="1" cellspacing="2" cellpadding="3" style="border-collapse: collapse; " >
  <thead>
    <tr>
      <td width="10"><strong>No</strong></td>
      <td ><strong>Bulan</strong></td>
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
 </center>    

</div>






</body>
</html>
