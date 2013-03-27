<?php
$pnr1=$_POST['pnr'];
error_reporting(1);
$url = "http://pnrapi.alagu.net/api/v1.0/pnr/$pnr1";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);       
curl_close($ch);
$out_arr = json_decode($output);
$sta=$out_arr->status;



if($sta=='OK')
{
$trname=$out_arr->data->train_name;
$fn=$out_arr->data->from->name;
$fnt=$out_arr->data->from->time;
$to=$out_arr->data->to->name;
$tot=$out_arr->data->to->time;
$boardinat=$out_arr->data->board->name;
$class=$out_arr->data->class;
$date=$out_arr->data->travel_date->date;
$i = 0;
foreach($out_arr->data->passenger[0] as $value){
 if($i == 0) {
 $myvalue=$value;
 }
$i++;
}
$chart=$out_arr->data->chart_prepared;
if($chart==1)
{
$charts="Prepared";
}
else {
  $charts="Not Yet";
}

echo <<<MYTAG
  <div id="content" style="background-color:#728FCE;height:1280px;width:768px;float:left;">

<form action="next.html" method="post">

<table border="0">

<tr><td>
  Your train name is <input type="text" value="$trname" size=40/>
</tr></td>

<tr><td>
  Your train is from <input type="text" value="$fn" size=40/>
</tr></td>

<tr><td>
  to <input type="text" value="$to" size=40/>
</tr></td>

<tr><td>
  Your train departure time <input type="text" value="$fnt" size=40/>
</tr></td>

<tr><td>
  Arrival time <input type="text" value="$tot" size=40/>
</tr></td>

<tr><td>
  Your boarding at <input type="text" value="$boardinat" size=40/>
</tr></td>

<tr><td>
  Your boarding date <input type="text" value="$date" size=40/>
</tr></td>

<tr><td>
  Your travelling in <input type="text" value="$class" size=40/>
</tr></td>

<tr><td>
  Your Current Status <input type="text" value="$myvalue" size=40/>
</tr></td>
<tr><td>
chart status <input type="text" value="$charts" size=40/>
</tr></td>
<tr><td>
<input type="submit"name="submit" value="Check Another"></th></tr> 
</tr></td>
</table>
</div>
MYTAG;

}
else
{

echo <<<MYTAG
<div id="content" style="background-color:#728FCE;height:1280px;width:768px;float:left;">

<form action="next.php" method="post">

<table border="0">

<tr><td>
Sorry thats an Invalid option Try with Correct PNR number
</tr></td>
<tr><td>
<input type="submit"name="submit" value="Check Another"></th></tr> 
</tr></td>
</table>
</div>
MYTAG;
}

?>
<!DOCTYPE html>
<html>
<body>
<script src="local:///chrome/webworks.js" type="text/javascript"></script>
<div id="container" style="width:768px">
<div id="header">
<h2 style="background-color:#41627E;" style="margin-bottom:0;">YOUR STATUS</h2></div>
</form>
</body>
</html>
