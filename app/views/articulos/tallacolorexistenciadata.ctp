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
foreach($result as $thisResult) {
$thisResult=$thisResult[0];
echo "<row id='".$thisResult['id']."'>";
echo "<cell>". $thisResult['color_cve']."</cell>";
echo "<cell>". (int)$thisResult['t0']."</cell>";
echo "<cell>". (int)$thisResult['t1']."</cell>";
echo "<cell>". (int)$thisResult['t2']."</cell>";
echo "<cell>". (int)$thisResult['t3']."</cell>";
echo "<cell>". (int)$thisResult['t4']."</cell>";
echo "<cell>". (int)$thisResult['t5']."</cell>";
echo "<cell>". (int)$thisResult['t6']."</cell>";
echo "<cell>". (int)$thisResult['t7']."</cell>";
echo "<cell>". (int)$thisResult['t8']."</cell>";
echo "<cell>". (int)$thisResult['t9']."</cell>";

echo "</row>\n";
//}
}
echo "</rows>\n";

