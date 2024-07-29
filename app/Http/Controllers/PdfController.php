<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Fetch data from your database or any other source
        $data = [
            'title' => 'Sample PDF',
            'content' => 'This is a sample PDF document.'
        ];

        // Load the view template with the data
        $html = view('pdf_template', $data)->render();

        // Create a new instance of Dompdf class
        $dompdf = new Dompdf();

        // Set options for PDF generation
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (optional: choose filename)
        $dompdf->render();

        // Output generated PDF to browser
        return $dompdf->stream('sample.pdf');
    }
}
