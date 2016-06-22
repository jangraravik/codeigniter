<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html,$pStatus,$filename) 
{
    require_once("mpdf60/mpdf.php");
	$makePDF=new mPDF('c','A4','freesans');
	$makePDF->SetProtection(array('print'));
	$makePDF->SetTitle("Ravi Trading Co. - Invoice");
	$makePDF->SetAuthor("Ravi Trading Co.");
	$makePDF->SetWatermarkText($pStatus);
	$makePDF->showWatermarkText = true;
	$makePDF->watermark_font = 'freesans';
	$makePDF->watermarkTextAlpha = 0.1;
	$makePDF->SetDisplayMode('fullpage');
	$makePDF->WriteHTML($html);
	$makePDF->Output($filename,'F');
	return file_exists($filename) ? "<a href='$filename'>Download Invoice Copy</a>":NULL;
}