<?php

namespace App\Http\Controllers;

use \TCPDF;
use App\Models\Pdf;
use Parsedown;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $markdown = '# Heading 1' . PHP_EOL . 'Some **bold** and *italic* text.';

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Markdown to PDF');

        $pdf->AddPage();

        $parsedown = new Parsedown();
        $html = $parsedown->text($markdown);

        $pdf->SetFont('helvetica', '', 11);

        $pdf->writeHTML($html);

        $pdf->Output('example.pdf', 'I');

    }
}
