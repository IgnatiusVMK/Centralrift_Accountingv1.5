<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Models\Account;
use App\Models\Financial;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CashBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    // Calculate the summary
    $totalCredit = Account::sum('Crd_Amnt');
    $totalDebit = Account::sum('Dbt_Amt');
    $balance = Account::orderBy('id', 'desc')->value('Bal');

    $cashbook = Account::where('Status', 'approved')->simplePaginate(15);

    return view('cashbook.cashbook', [
        'cashbook'=> $cashbook,
        'totalCredit' => $totalCredit,
        'totalDebit' => $totalDebit,
        'balance' => $balance,
    ]);
    
        
    }

    public function exportPdf()
    {

         // Calculate the summary
        $totalCredit = Account::sum('Crd_Amnt');
        $totalDebit = Account::sum('Dbt_Amt');
        $balance = Account::orderBy('id', 'desc')->value('Bal');

        $cashbook = Account::all();
    
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);
    
        $now = Carbon::now('Africa/Nairobi');
        $pdfName = 'CB-' . $now->format('Y-m-d-H:i:s') . '.pdf';

        $data = compact('cashbook', 'totalCredit', 'totalDebit', 'balance');
    
        // Render the view to HTML
        $html = view('cashbook.pdf', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Return the PDF as a download
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfName . '"')
            ->header('Content-Length', strlen($dompdf->output()));
    }

    public function sendAsMail(Request $request)
    {

        $now = Carbon::now('Africa/Nairobi');
        $currentTime = $now->format('Y-m-d h:i:s');

        $request->validate([
            'mail_to' => 'required',
        ]);

        $dispatchData = [
            'mail_to' => $request->mail_to,
            'subject' => "Monthly Cashbook Report",
            'message' => "Your cashbook for this month has been exported today as at; " . $currentTime .", and has been attached below.",
            'mailable' => "CashbookMail",
            'user_name' => Auth::user()->name,
        ];

        dispatch(new SendMail($dispatchData));
        /* SendMail::dispatch($dispatchData); */

        toastr()->success('Mail sent successfully');
        return redirect('/cashbook');
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
