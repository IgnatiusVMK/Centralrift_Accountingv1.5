<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Credit;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credits = Credit::where('Status', 'approved')->get();
        return view('credit.credit', compact('credits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniqueCode = $this->generateUniqueCode('Credit');
        return view('credit.create', ['uniqueCode' => $uniqueCode]);
    }

    public function store(Request $request){
        $request->validate([
            'Credit_Id' => 'required|max:255|string',
            'Source' => 'required|max:255|string',
            'Description' => 'required|max:255|string',
            'Amount' => 'required|integer|max:1000000'
        ]);


        $data = $request->all();
        
        Credit::create($data);

        $this->payIn($request->Amount, $request->Credit_Id, $request->Source.' - '.$request->Description);

        return redirect('credit/create')->with('success','Credit Recorded');
    }

    public function payIn($amount, $Credit_Id, $Source)
    {
        $transactionId = $this->getNextTransactionId();
    
        $lastAccount = Account::latest()->first();
        $balance = $lastAccount ? $lastAccount->Bal : 0;
        $balance += $amount;
    
        Account::create([
            'Transaction_Id' => $transactionId,
            'Financial_Id' => $Credit_Id,
            'Description' => $Source,
            'Crd_Amnt' => $amount,
            'Dbt_Amt' => 0,
            'Bal' => $balance,
            'Crd_Dbt_Date' => now(),
            'Date_Created' => now(),
        ]);
    }
    
    public function getNextTransactionId()
    {
        $lastAccount = Account::latest()->first();
        $lastTransactionId = $lastAccount ? $lastAccount->Transaction_Id : 'Txd-' . date('nY') . '-0';
        $lastNumber = intval(substr(strrchr($lastTransactionId, "-"), 1));
        $newNumber = $lastNumber + 1;
    

        $newTransactionId = 'Txd-' . date('nY') . '-' . $newNumber;
    
        return $newTransactionId;
    }

    public function creditNote()
    {
        return view('credit.credit-note');
    }

    public function generateCreditNote(Request $request, string $Credit_Id)
    {
        // Retrieve all sales records for the given Credit_Id
        $credits = Credit::where('Credit_Id', $Credit_Id)->get();

        $creditDetails = Credit::where('Credit_Id', $Credit_Id)->first();

        $credit_note = Credit::where('Credit_Id', $Credit_Id)->first();


        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true); // To load remote resources like images

        $dompdf = new Dompdf($options);

        //dd($credits);

        // $now = Carbon::now('Africa/Nairobi');
        $pdfName = 'Credit-Note-' . $credit_note->Description . '-' . $credit_note->id .'.pdf';

        // Pass the credit collection to the view
        $data = compact('credits', 'creditDetails');

        // Render the view to HTML
        $html = view('credit.credit-note', $data)->render();
        $dompdf->loadHtml($html);

        // Set paper size and margins using the correct method
        $dompdf->setPaper('A4', 'portrait');

        // If you need custom margins, use the following to set margins (not set_option):
        $dompdf->set_option('isRemoteEnabled', true); // Make sure remote content (like images) is allowed
        $dompdf->render();

        // Return the PDF as a download
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $pdfName . '"')
            ->header('Content-Length', strlen($dompdf->output()));
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
    private function generateUniqueCode($type)
    {

        $lastCredit = Credit::latest()->first();
    
        $lastCode = $lastCredit ? $lastCredit->unique_code : '';
        $lastNumber = intval(substr(strrchr($lastCode, "-"), 1)); 
    
        $prefix = strtoupper(substr($type, 0, 4));
        $newNumber = $lastNumber + 1;
        $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
    
        while (Credit::where('Credit_Id', $uniqueCode)->exists()) {
            $newNumber++;
            $uniqueCode = $prefix . '-' . date('Ymd') . '-' . $newNumber;
        }
    
        return $uniqueCode;
    }
}
