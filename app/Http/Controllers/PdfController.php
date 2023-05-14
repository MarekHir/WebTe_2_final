<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \TCPDF;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('MMMM');
        $pdf->SetTitle('project.title');
        $pdf->SetSubject('PDF Subject');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Add a page
        $pdf->AddPage();

        // Set some content
        $pdf->SetFont('freeserif', 'B', 20, '', true);
        $pdf->Cell(0, 10, trans('project.pdfText'), 0, 1);

        // Output the PDF as a download
        $pdf->Output('example.pdf', 'D');
    }
}
