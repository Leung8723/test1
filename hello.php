<?php
$get=floatval(9.075);
$tmp=ceil($get)-1;
echo $tmp;

$fee=floatval(9.10);
echo $fee."<br/>";
$res=floatval($fee-$tmp)*100;
echo $res."\n";
if ($res==10){
    echo 111;
}else{
    echo 222;
}
?>