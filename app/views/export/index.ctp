<?php
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('Calibri', 12);
// add data - starting on first row
$this->PhpExcel->addRow(array('ccc','ddd'));
// skip to 4th row
$this->PhpExcel->setRow(4);
// add data starting from column AC
$this->PhpExcel->addRow(array('fff','ggg'), 'AC');
// add data starting from 5th column E
$this->PhpExcel->addRow(array('iii','jjj'), 4);
// output to browser
$this->PhpExcel->output();
?>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
