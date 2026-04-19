<?php

namespace App\Http\Controllers;

use App\Models\CustomerProductPricing;
use App\Models\Customers;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexComm(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month', date('Y-m')); // default to current month

        $query = Invoice::with('customer', 'items.product');

        if ($month) {
            $query->whereYear('date', substr($month, 0, 4))
                ->whereMonth('date', substr($month, 5, 2));
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%$search%")
                ->orWhereHas('customer', function($q2) use ($search) {
                    $q2->where('Customer_Name', 'like', "%$search%");
                });
            });
        }

        $invoices = $query->orderBy('invoice_number', 'asc')
            ->whereHas('items', fn($q) => $q->where('type', 'commercial'))
            ->with(['items' => fn($q) => $q->where('type', 'commercial')])
            ->get();


        return view('invoices.indexComm', compact('invoices'));
    }
    public function indexProforma(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month', date('Y-m')); // default to current month

        $query = Invoice::with('customer', 'items.product');

        if ($month) {
            $query->whereYear('date', substr($month, 0, 4))
                ->whereMonth('date', substr($month, 5, 2));
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%$search%")
                ->orWhereHas('customer', function($q2) use ($search) {
                    $q2->where('Customer_Name', 'like', "%$search%");
                });
            });
        }

        $invoices = $query->orderBy('invoice_number', 'asc')
            ->whereHas('items', fn($q) => $q->where('type', 'proforma'))
            ->with(['items' => fn($q) => $q->where('type', 'proforma')])
            ->get();


        return view('invoices.indexProforma', compact('invoices'));
    }

    public function ajaxSearchComm(Request $request)
    {
        $query = $request->input('search');
        $month = $request->input('month', date('Y-m'));

        // Parse month to date range (first and last day of month)
        $startDate = date('Y-m-01', strtotime($month));
        $endDate = date('Y-m-t', strtotime($month));

        $invoices = Invoice::with([
            'customer',
            'items' => function ($q) {
                $q->where('type', 'commercial')
                ->with('product');
            }
        ])
        ->orderBy('invoice_number', 'asc')
        ->whereHas('items', function($q) {
            $q->where('type', 'commercial');
        })
        ->whereBetween('date', [$startDate, $endDate])
        ->when($query, function ($q) use ($query) {
            $q->where(function ($subq) use ($query) {
                $subq->where('invoice_number', 'like', "%{$query}%")
                    ->orWhereHas('customer', function ($custq) use ($query) {
                        $custq->where('Customer_Name', 'like', "%{$query}%");
                    });
            });
        })
        ->get();


        // Return a JSON response with rendered HTML for the invoice table rows
        $html = view('invoices.partials.invoice_rows', compact('invoices'))->render();

        return response()->json(['html' => $html]);
    }

    /* protected function buildInvoicePdf($invoices, $customer, $invoiceDate)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Pass to the same invoice blade (you can reuse it as it already groups by type)
        $data = compact('invoices', 'customer', 'invoiceDate');
        $html = view('invoices.templates.commercial-invoice', $data)->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }


    public function generateMultipleInvoices(Request $request)
    {
        $invoiceIds = json_decode($request->selected_invoices, true);

        $invoices = Invoice::with(['customer', 'items.product'])
            ->whereIn('id', $invoiceIds)
            ->get();

        if ($invoices->isEmpty()) {
            return back()->with('error', 'No invoices found.');
        }

        // Group invoices by customer + invoice date
        $grouped = $invoices->groupBy(function ($invoice) {
            return $invoice->customer_id . '|' . $invoice->date;
        });

        $zip = new ZipArchive();
        $zipFileName = 'Invoices-' . now()->format('Y-m-d-His') . '.zip';
        $zipPath = storage_path("app/$zipFileName");

        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            foreach ($grouped as $key => $invoiceGroup) {
                [$customerId, $date] = explode('|', $key);

                $customer = Customers::find($customerId);
                $pdfOutput = $this->buildInvoicePdf($invoiceGroup, $customer, $date);

                $fileName = "Invoice-{$customer->Customer_Name}-{$date}.pdf";
                $zip->addFromString($fileName, $pdfOutput);
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function downloadInvoicesZip()
{
    $invoices = Invoice::with(['customer', 'items.product'])
        ->orderBy('invoice_number', 'asc')
        ->whereHas('items', function ($q) {
            $q->where('type', 'commercial');
        })
        ->whereBetween('date', ['2025-08-01', '2025-08-31']) // adjust your dates
        ->get();

    if ($invoices->isEmpty()) {
        return back()->with('error', 'No invoices found for this period.');
    }

    // Create a temporary zip file
    $zipFileName = 'invoices_' . now()->format('Ymd_His') . '.zip';
    $zipFilePath = storage_path("app/$zipFileName");

    $zip = new ZipArchive;
    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        foreach ($invoices as $invoice) {
            $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
            $pdfContent = $pdf->output();

            // Each invoice saved as invoice_<number>.pdf inside the zip
            $zip->addFromString("invoice_{$invoice->invoice_number}.pdf", $pdfContent);
        }
        $zip->close();
    }

    return response()->download($zipFilePath)->deleteFileAfterSend(true);
} */

public function downloadSelectedCommercialInvoicesZip(Request $request)
{
    // support either JSON string from your JS or an array
    $selected = $request->input('selected_invoices', $request->input('invoice_ids', null));
    if (is_string($selected)) {
        $invoiceIds = json_decode($selected, true);
    } elseif (is_array($selected)) {
        $invoiceIds = $selected;
    } else {
        $invoiceIds = [];
    }

    if (empty($invoiceIds)) {
        return back()->with('error', 'No invoices selected.');
    }

    // eager-load customer (and nested invoiceAddress) and items->product
    $invoices = Invoice::with(['customer.invoiceAddress', 'items.product'])
        ->whereIn('id', $invoiceIds)
        ->get();

    if ($invoices->isEmpty()) {
        return back()->with('error', 'No invoices found.');
    }

    $zipFileName = 'commercial_invoices_' . now()->format('Ymd_His') . '.zip';
    $zipPath = storage_path("app/{$zipFileName}");

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return back()->with('error', 'Could not create zip file.');
    }

    foreach ($invoices as $invoice) {
        // ensure customer is present
        $customer = $invoice->customer;

        // render commercial invoice view
        $pdf = PDF::loadView('invoices.templates.commercial-invoice', [
            'invoice'  => $invoice,
            'customer' => $customer,
        ]);

        $fileName = 'Commercial_Invoice_' . ($invoice->customer->Customer_Name ?? 'Customer') . '_' . ($invoice->invoice_number ?? $invoice->id) . '.pdf';
        $zip->addFromString($fileName, $pdf->output());
    }

    $zip->close();

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

public function downloadSelectedProformaInvoicesZip(Request $request)
{
    // support either JSON string from your JS or an array
    $selected = $request->input('selected_invoices', $request->input('invoice_ids', null));
    if (is_string($selected)) {
        $invoiceIds = json_decode($selected, true);
    } elseif (is_array($selected)) {
        $invoiceIds = $selected;
    } else {
        $invoiceIds = [];
    }

    if (empty($invoiceIds)) {
        return back()->with('error', 'No invoices selected.');
    }

    // eager-load customer (and nested invoiceAddress) and items->product
    $invoices = Invoice::with(['customer.invoiceAddress', 'items.product'])
        ->whereIn('id', $invoiceIds)
        ->get();

    if ($invoices->isEmpty()) {
        return back()->with('error', 'No invoices found.');
    }

    $zipFileName = 'proforma_invoices_' . now()->format('Ymd_His') . '.zip';
    $zipPath = storage_path("app/{$zipFileName}");

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return back()->with('error', 'Could not create zip file.');
    }

    foreach ($invoices as $invoice) {
        // ensure customer is present
        $customer = $invoice->customer;

        // render proforma invoice view (different template)
        $pdf = PDF::loadView('invoices.templates.proforma-invoice', [
            'invoice'  => $invoice,
            'customer' => $customer,
        ]);

        $fileName = 'Proforma_Invoice_' . ($invoice->customer->Customer_Name ?? 'Customer') . '_' . ($invoice->invoice_number ?? $invoice->id) . '.pdf';
        $zip->addFromString($fileName, $pdf->output());
    }

    $zip->close();

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

    /* public function downloadSelectedInvoicesZip(Request $request)
{
    // support either JSON string from your JS or an array
    $selected = $request->input('selected_invoices', $request->input('invoice_ids', null));
    if (is_string($selected)) {
        $invoiceIds = json_decode($selected, true);
    } elseif (is_array($selected)) {
        $invoiceIds = $selected;
    } else {
        $invoiceIds = [];
    }

    if (empty($invoiceIds)) {
        return back()->with('error', 'No invoices selected.');
    }

    // eager-load customer (and nested invoiceAddress) and items->product
    $invoices = Invoice::with(['customer.invoiceAddress', 'items.product'])
        ->whereIn('id', $invoiceIds)
        ->get();

    if ($invoices->isEmpty()) {
        return back()->with('error', 'No invoices found.');
    }

    $zipFileName = 'invoices_' . now()->format('Ymd_His') . '.zip';
    $zipPath = storage_path("app/{$zipFileName}");

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return back()->with('error', 'Could not create zip file.');
    }

    foreach ($invoices as $invoice) {
        // ensure customer is present
        $customer = $invoice->customer;

        // render single-invoice view and pass both $invoice and $customer
        $pdf = PDF::loadView('invoices.templates.commercial-invoice', [
            'invoice'  => $invoice,
            'customer' => $customer,
        ]);

        $fileName = 'Centralrift '. ($invoice->customer->Customer_Name) .'Invoice_' . ($invoice->invoice_number ?? $invoice->id) . '.pdf';
        $zip->addFromString($fileName, $pdf->output());
    }

    $zip->close();

    return response()->download($zipPath)->deleteFileAfterSend(true);
} */

    public function ajaxSearchProforma(Request $request)
    {
        $query = $request->input('search');
        $month = $request->input('month', date('Y-m'));

        // Parse month to date range (first and last day of month)
        $startDate = date('Y-m-01', strtotime($month));
        $endDate = date('Y-m-t', strtotime($month));

        $invoices = Invoice::with([
            'customer',
            'items' => function ($q) {
                $q->where('type', 'proforma')
                ->with('product');
            }
        ])
        ->orderBy('invoice_number', 'asc')
        ->whereHas('items', function($q) {
            $q->where('type', 'proforma');
        })
        ->whereBetween('date', [$startDate, $endDate])
        ->when($query, function ($q) use ($query) {
            $q->where(function ($subq) use ($query) {
                $subq->where('invoice_number', 'like', "%{$query}%")
                    ->orWhereHas('customer', function ($custq) use ($query) {
                        $custq->where('Customer_Name', 'like', "%{$query}%");
                    });
            });
        })
        ->get();


        // Return a JSON response with rendered HTML for the invoice table rows
        $html = view('invoices.partials.invoice_rows', compact('invoices'))->render();

        return response()->json(['html' => $html]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customers::get();
        $products = Product::get();
        return view('invoices.create-invoice', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::debug('Raw input:', $request->all());

        $validated = $request->validate([
            'customer_id' => 'required|numeric|max:255',
            'invoice_number' => 'required|numeric|max:255',
            'order_number' => 'nullable|numeric|max:255',
            'date' => 'required|date',
            'currency' => 'required|string|max:3',

            'produce' => 'required|array',
            'produce.*.product_id' => 'required|numeric',
            'produce.*.description' => 'required|string|max:255',
            'produce.*.weight' => 'required|numeric',
        ]);

        Log::debug('Validated input:', $validated);

        try {
            DB::beginTransaction();

            // Save Invoice header details
            $invoice = Invoice::create([
                'customer_id' => $validated['customer_id'],
                'invoice_number' => $validated['invoice_number'],
                'order_number' => $validated['order_number'],
                'date' => $validated['date'],
                'currency' => $validated['currency'],
            ]);

            // Save Invoice_items produce details
            foreach ($validated['produce'] as $produceItem) {
            Log::debug('Creating invoice items for produce:', $produceItem);

            $CustomerProductPricing_proforma = CustomerProductPricing::where('customer_id', $validated['customer_id'])
                ->where('product_id', $produceItem['product_id'])
                ->where('type', 'proforma')
                ->first();

            $CustomerProductPricing_commercial = CustomerProductPricing::where('customer_id', $validated['customer_id'])
                ->where('product_id', $produceItem['product_id'])
                ->where('type', 'commercial')
                ->first();

            // Create proforma InvoiceItem if pricing exists
            if ($CustomerProductPricing_proforma) {
                InvoiceItem::firstOrCreate([
                    'invoice_id' => $invoice->id,
                    'product_id' => $produceItem['product_id'],
                    'type' => 'proforma',
                    'description' => $produceItem['description'],
                    'weight' => $produceItem['weight'],
                    'unit_price' => $CustomerProductPricing_proforma->price,
                    'total' => $CustomerProductPricing_proforma->price * $produceItem['weight'],
                ]);

            }

            // Create commercial InvoiceItem if pricing exists
            if ($CustomerProductPricing_commercial) {
                InvoiceItem::firstOrCreate([
                    'invoice_id' => $invoice->id,
                    'product_id' => $produceItem['product_id'],
                    'type' => 'commercial',
                    'description' => $produceItem['description'],
                    'weight' => $produceItem['weight'],
                    'unit_price' => $CustomerProductPricing_commercial->price,  // use commercial price
                    'total' => $CustomerProductPricing_commercial->price * $produceItem['weight'], // example total calc
                ]);

            }
        }


            DB::commit();

            return redirect()->route('invoice.create')->with('status', 'Invoice created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Invoice creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $customer_id, int $invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)
                        ->where('customer_id', $customer_id)
                        ->first();

        if (!$invoice) {
            return redirect()->route('invoice.index')->with('error', 'Invoice not found.');
        }

        return view('invoices.review.view-invoice', compact('invoice'));
    }


    public function review(Request $request)
    {
        $invoice_number = $request->invoice_number;

        $invoice = Invoice::where('invoice_number', $invoice_number)
                            /* ->where('type', 'commercial') */
                            ->first();

        if (!$invoice) {
            return redirect()->route('invoice.index')->with('error', 'Invoice not found.');
        }

        $customer = Customers::find($invoice->customer_id); // assuming invoice has customer_id

        if (!$customer) {
            return back()->with('error', 'Customer not found.');
        }

        $invoices = $customer->invoices()
            ->with('items.product.category')
            ->orderBy('invoice_number', 'asc')
            ->get();

        $pdf = Pdf::loadView('invoices.review.review', [
            'invoice' => $invoice,
            'customer' => $customer,
        ])->setPaper('a4', 'portrait')
        ->setOption([
            'margin-left' => 20,
            'margin-right' => 20,
            'margin-top' => 20,
            'margin-bottom' => 20,
        ]);

        // Stream the PDF directly to the iframe
        return $pdf->stream('invoice_' . $invoice_number . '.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

}