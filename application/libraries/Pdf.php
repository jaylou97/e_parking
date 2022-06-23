<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{

	const HEADER_LOGO_WIDTH = 25;
	const HEADER_TITLE = 'ALTURAS GROUP OF COMPANIES';
	const HEADER_STRING = 'HRMS-EMPLOYEE\'S BENEFITS MODULE';

	private $payperiod;

	public function __construct($params = NULL)
	{
		parent::__construct('L', 'mm', 'JUNIORLETTER', true, 'UTF-8', false);
		$this->SetCreator(PDF_CREATOR);
		$this->SetAuthor($_SESSION['name']);
		$this->SetTitle('Payroll Deduction Slip');
		$this->SetSubject('EBM-Salary Deductions');
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetMargins(10, 10, 10);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->payperiod = $params['payperiod'];
	}

	public function header()
	{
		$this->SetFont('helvetica', 'B', 10);
		// $this->Cell(0, 0, self::HEADER_TITLE, 0, 1, 'L', 0, '', 0);
		// $this->Cell(0, 0, self::HEADER_STRING, 0, 1, 'L', 0, '', 0);
		$this->Cell(0, 0, 'DEDUCTION DETAILS FOR THE MONTH OF ' . strtoupper(date('F d, Y', strtotime($this->payperiod))), 0, 1, 'L', 0, '', 0);
		// $this->Ln(2);
	}

	public function footer()
	{
		// $this->SetY(-155);
		$this->SetY(125);
		$this->SetFont('helvetica', '', 10);

		// $this->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		// $this->SetFillColor(255,255,255);
		// $this->MultiCell(60, 4, "Payroll Clerk's Signature", 'T', 'C', 1, 0, 40);

		$this->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		$this->SetFillColor(255,255,255);
		// Page number
		$this->SetFont('helvetica', '', 8);
        $this->Cell(0, 0, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
		// Employee's signature
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(60, 4, "Employee's Signature", 'T', 'C', 1, 0, 145);
	}

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */