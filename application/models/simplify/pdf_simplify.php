<?php

class pdf_simplify extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        /*$this->db2 = $this->load->database('hr', TRUE);
        $this->db3 = $this->load->database('cons', TRUE);*/
    }

    function reports_mainheader($pdf, $bu, $cutoff, $module)
	{
		$pdf->SetFont('Arial','B',11);
		$pdf->ln(3);
		/*$pdf->Image(base_url().'assets/img/logo1.png',165,10,25,0,'PNG');		 */
		$pdf->Cell(0,0,'ALTURAS GROUP OF COMPANIES',0,0,'L');
		$pdf->ln(6);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(0,0, 'OTHER DEDUCTION MODULE',0,0,'L');		 	
		$pdf->ln(10);
		$pdf->Cell(0,0,'Uploaded Summary - '.date('F d, Y', strtotime($cutoff)),0,0,'L');
		$pdf->ln(6);
	}


	function reports_tableheader($pdf, $section_name,$header_name,$header_width)
	{
		$pdf->ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->SetTextColor(225,50,50);
		$pdf->Cell(20,7,$section_name,0,0,'L');
		$pdf->SetTextColor(0);
		$pdf->ln();

		for($a=0;$a<count($header_name);$a++)
		{
		   $pdf->Cell($header_width[$a],6,$header_name[$a],1,0,'C',true);	
		}
		




		/*$pdf->Cell(100,6,'NAME',1,0,'C',true);
		$pdf->Cell(25,6,'DEBIT',1,0,'C',true);
		$pdf->Cell(25,6,'CREDIT',1,0,'C',true);*/
		/*$pdf->Cell(25,6,'BALANCE',1,0,'C');*/
	/*	$pdf->MultiCell(20,3, " Joseph Rian B. Cirunay   Jay  lou" ,1,'L',false);
		$pdf->MultiCell(20,3, " Joseph Rian B. Cirunay   Jay  lou" ,1,'L',false);
		$pdf->MultiCell(20,3, " Joseph Rian B. Cirunay   Jay  lou" ,1,'L',false);
		$pdf->MultiCell(20,3, " Joseph Rian B. Cirunay   Jay  lou" ,1,'L',false);
		$pdf->MultiCell(20,3, "\nJoseph Rian B. Cirunay \n\n Jay  lou" ,1,'L',false);*/
		$pdf->ln();
	}

	/*
  		MultiCell(float w, float h, string txt , border , align , boolean )


		w
		    Width of cells. If 0, they extend up to the right margin of the page. 
		h
		    Height of cells. 
		txt
		    String to print. 
		border
		    Indicates if borders must be drawn around the cell block. The value can be either a number:

		        0: no border
		        1: frame

		    or a string containing some or all of the following characters (in any order):

		        L: left
		        T: top
		        R: right
		        B: bottom

		    Default value: 0. 
		align
		    Sets the text alignment. Possible values are:

		        L: left alignment
		        C: center
		        R: right alignment
		        J: justification (default value)

		fill
		    Indicates if the cell background must be painted (true) or transparent (false). Default value: false. 
    */

}