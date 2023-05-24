<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Parsedown;
use TCPDF;

class PdfGeneratorService extends AbstractService
{

    public function run(...$args)
    {
        $instruction = $args[0];
        $user = $args[1];

        $markdown = $instruction->markdown;

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator($user->fullName());
        $pdf->SetAuthor($user->fullName());
        $pdf->SetTitle($instruction->name);

        $pdf->AddPage();

        $parsedown = new Parsedown();
        $html = $parsedown->text($markdown);

        $pdf->SetFont('helvetica', '', 11);

        $pdf->writeHTML($html);

        $pdf->Output($instruction->name);
    }
}
