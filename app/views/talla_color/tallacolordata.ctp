<?php
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
header("Content-type: application/xhtml+xml;charset=utf-8");
} else {
header("Content-type: text/xml;charset=utf-8");
}
echo "<?xml version='1.0' encoding='utf-8'?>\n";
echo "<rows>\n";
echo "<page>1</page>\n";
//echo "<total>".$this->Paginator->total()."</total>";
//echo "<records>".$this->Paginator->records()."</records>";
// be sure to put text data in CDATA
foreach($result as $thisResult) {
echo "<row id='".$thisResult['Artexist']['id']."'>";
echo "<cell>". $thisResult['Artexist']['aecolor']."</cell>";
echo "<cell>". $thisResult['Talla']['tat0']."</cell>";
echo "<cell>". $thisResult['Talla']['tat1']."</cell>";
echo "<cell>". $thisResult['Talla']['tat2']."</cell>";
echo "<cell>". $thisResult['Talla']['tat3']."</cell>";
echo "<cell>". $thisResult['Talla']['tat4']."</cell>";
echo "<cell>". $thisResult['Talla']['tat5']."</cell>";
echo "<cell>". $thisResult['Talla']['tat6']."</cell>";
echo "<cell>". $thisResult['Talla']['tat7']."</cell>";
echo "<cell>". $thisResult['Talla']['tat8']."</cell>";
echo "<cell>". $thisResult['Talla']['tat9']."</cell>";

echo "</row>\n";
//}
}
echo "</rows>\n";
?>