<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Invoice::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $invoices = $query->latest()->paginate(15)->appends($request->query());

        $stats = [
            'total'   => Invoice::count(),
            'paid'    => Invoice::where('status', 'paid')->count(),
            'unpaid'  => Invoice::whereIn('status', ['draft', 'sent', 'partial', 'overdue'])->count(),
            'overdue' => Invoice::where('status', 'overdue')->count(),
        ];

        return view('admin.invoices.index', compact('invoices', 'stats'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load('order.items');

        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $invoice->load('order.items');

        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $request->validated();

        // Recalculate total from the stored subtotal + updated discount/tax
        $subtotal    = (float) $invoice->subtotal;
        $discountPct = (float) ($data['discount'] ?? 0);
        $taxPct      = (float) ($data['tax'] ?? 0);
        $discAmt     = $subtotal * ($discountPct / 100);
        $taxAmt      = ($subtotal - $discAmt) * ($taxPct / 100);
        $total       = round($subtotal - $discAmt + $taxAmt, 2);

        $invoice->update([
            'status'         => $data['status'],
            'client_name'    => $data['client_name'],
            'client_email'   => $data['client_email'],
            'client_phone'   => $data['client_phone'] ?? null,
            'client_company' => $data['client_company'] ?? null,
            'client_address' => $data['client_address'] ?? null,
            'issue_date'     => $data['issue_date'],
            'due_date'       => $data['due_date'],
            'discount'       => $data['discount'] ?? 0,
            'tax'            => $data['tax'] ?? 0,
            'total'          => $total,
            'note'           => $data['note'] ?? null,
        ]);

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    public function generateFromOrder(Order $order): RedirectResponse
    {
        if ($order->invoice) {
            return redirect()->route('admin.invoices.show', $order->invoice)
                ->with('info', 'An invoice already exists for this order.');
        }

        $order->load('items');

        $invoice = DB::transaction(function () use ($order) {
            $paymentLabels = [
                'cod'         => 'Cash on Delivery',
                'credit_card' => 'Credit Card',
                'paypal'      => 'PayPal',
                'gpay'        => 'Google Pay',
            ];

            $addressParts = array_filter([
                $order->address,
                $order->city,
                $order->state,
                $order->zip_code,
                $order->country,
            ]);

            $invoice = Invoice::create([
                'order_id'       => $order->id,
                'status'         => $order->payment_status === 'paid' ? 'paid' : 'sent',
                'client_name'    => $order->customer_name,
                'client_email'   => $order->customer_email,
                'client_phone'   => $order->customer_phone,
                'client_address' => implode(', ', $addressParts),
                'issue_date'     => now()->toDateString(),
                'due_date'       => now()->toDateString(),
                'subtotal'       => $order->subtotal,
                'discount'       => 0,
                'tax'            => 0,
                'total'          => $order->total,
                'note'           => 'Payment method: ' . ($paymentLabels[$order->payment_method] ?? $order->payment_method),
            ]);

            $invoice->update([
                'invoice_number' => 'INV-' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT),
            ]);

            return $invoice;
        });

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice ' . $invoice->invoice_number . ' generated from order ' . $order->order_number . '.');
    }

    public function markPaid(Invoice $invoice): RedirectResponse
    {
        $invoice->update(['status' => 'paid']);

        return redirect()->back()->with('success', 'Invoice marked as paid.');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted.');
    }
}
