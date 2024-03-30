<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Financial;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CashBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $cashbook = Account::get(); */
        $cashbook = Account::simplePaginate(15);
        return view("cashbook.cashbook", compact('cashbook'));
    }

    public function exportPdf()
{
    $cashbook = Account::all(); // Get all entries without pagination
    $dompdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf->setOptions($options);

    $now = Carbon::now();

    $now = Carbon::now('Africa/Nairobi');
    $pdfName = 'CB-' . $now->format('Y-m-d-H:i:s') . '.pdf';

    // Accumulate PDF content for all entries
    $allPagesContent = '';

    $data = [
        'cashbook' => $cashbook
    ];

    $html = view('cashbook.pdf', $data)->render();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Set headers for PDF download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $pdfName . '"');
    header('Content-Length: ' . strlen($dompdf->output()));

    // Output the entire PDF content
    echo $dompdf->output();

    // Exit to prevent further output
    exit();
}




    

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
