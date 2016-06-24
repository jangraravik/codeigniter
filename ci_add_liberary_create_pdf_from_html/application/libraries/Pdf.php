<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf
{
	public function __construct()
	{
		require_once APPPATH.'third_party/mpdf60/mpdf.php';
	}

	public function create($html,$filename,$payStatus = 'Invoice',$filetitle = 'Invoice')
	{
		//return "Creating PDF Called";
		$filename = $filename.".pdf";
		$makePDF = new mPDF('c','A4','freesans');
		$makePDF->SetProtection(array('print'));
		$makePDF->SetTitle("Ravi Trading Co. - Invoice");
		$makePDF->SetAuthor("Ravi Trading Co.");
		$makePDF->SetWatermarkText($payStatus);
		$makePDF->showWatermarkText = true;
		$makePDF->watermark_font = 'freesans';
		$makePDF->watermarkTextAlpha = 0.1;
		$makePDF->SetDisplayMode('fullpage');
		$makePDF->WriteHTML($html);
		$makePDF->Output($filename,'F');
	}

	public function dLink($file,$tag="click to download pdf")
	{
		return file_exists($file) ? "<a href='".base_url($file)."'>$tag</a>":NULL;
	}
}