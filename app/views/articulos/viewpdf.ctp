<?php 
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("JUNIOR DE MEXICO, SA DE CV"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setHeaderFont(array($textfont,'',40)); 
$tcpdf->xheadercolor = array(150,0,0); 
$tcpdf->xheadertext = 'JUNIOR DE MEXICO, SA DE CV'; 
$tcpdf->xfootertext = 'Copyright Â© %d KBS Homes & Properties. All rights reserved.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
$i=1;
$h=20;
$tcpdf->SetTextColor(0, 0, 0); 
$tcpdf->SetFont($textfont,'B',20); 
$tcpdf->Cell(0,($i++*$h), "Hello World", 0,1,'L'); 
$tcpdf->Cell(0,($i++*$h), $property['Articulo']['arcveart'], 0,1,'L'); 
$tcpdf->Cell(0,($i++*$h), $property['Articulo']['ardescrip'], 0,1,'L'); 
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('filename.pdf', 'D'); 

?> 