<?php echo $session->flash();?>
<?php
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
header("Content-type: application/xhtml+xml;charset=utf-8");
} else {
header("Content-type: text/xml;charset=utf-8");
}
echo "<?xml version='1.0' encoding='utf-8'?>\n";
?>
<?php
echo "<rows>\n";
echo "<page>1</page>\n";
//echo "<total>".$this->Paginator->total()."</total>";
//echo "<records>".$this->Paginator->records()."</records>";
// be sure to put text data in CDATA
foreach($result as $thisResult) {
	
echo "<row id='".$thisResult['Facturadet']['child_id']."'>";
echo "<cell>". $thisResult['Color']['color_cve']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t0']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t1']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t2']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t3']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t4']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t5']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t6']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t7']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t8']."</cell>";
echo "<cell>". (int)$thisResult['Facturadet']['t9']."</cell>";

echo "</row>\n";
//}
}
echo "</rows>\n";
?>
