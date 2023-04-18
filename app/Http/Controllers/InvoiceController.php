<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
  public function index() {
    $invoices = Invoice::all();
    return view('invoices.index', compact('invoices'));
  }

  public function create() {
    $sections = Section::all();
    $products = Product::all();
    return view('invoices.create', compact('sections', 'products'));
  }

  public function store(Request $request) {
    $request->validate([
      'invoice_number' => 'required|unique:invoices',
      'Date' => 'required|date',
      'Due_date' => 'required|date',
      'product' => 'required',
      'Section' => 'required',
      'Amount_collection' => 'required',
      'Amount_Commission' => 'required',
      'Discount' => 'required',
      'Value_VAT' => 'required',
      'Rate_VAT' => 'required',
      'Total' => 'required',
      'invoice_attachment' => 'required|max:10000|mimes:pdf,doc,docx,xlsx,pptx',
    ]);

    if($request->hasFile('invoice_attachment')) {
      $file = $request->file('invoice_attachment')->getClientOriginalName();
      $path = $request->file('invoice_attachment')->storeAs('invoices-attachments', $file, 'public_path');
    } else {
      $path = null;
    }

    Invoice::create([
      'invoice_number' => $request->invoice_number,
      'invoice_date' => $request->Date,
      'invoice_due_date' => $request->Due_date,
      'invoice_product' => $request->product,
      'section_id' => $request->Section,
      'invoice_amount_collection' => $request->Amount_collection,
      'invoice_amount_commission' => $request->Amount_Commission,
      'invoice_discount' => $request->Discount,
      'invoice_value_vat' => $request->Value_VAT,
      'invoice_rate_vat' => $request->Rate_VAT,
      'invoice_total' => $request->Total,
      'invoice_status' => 0,
      'invoice_note' => $request->note,
      'invoice_attachment' => $path,
      'created_by' => (Auth::user()->name)
    ]);

    session()->flash('add', 'تم اضافة الفاتورة بنجاح');
    return redirect('/invoices');
  }

  public function show(int $id) {
    $invoice = Invoice::findorFail($id);
    return view('invoices.show', compact('invoice'));
  }

  public function destroy(Request $request) {
    $invoice_id = $request->id;
    Invoice::find($invoice_id)->delete();
    session()->flash('delete', 'تم حذف الفاتورة بنجاح');
    return redirect('/invoices');
  }

  public function GetProducts(int $id) {
    $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
    return json_encode($products);
  }

  public function PayInvoice(int $id) {
    $invoice = Invoice::find($id);
    $invoice->invoice_status = 1;
    $invoice->payment_date = Carbon::now();
    $invoice->save();

    session()->flash('edit', 'تم تغيير حالة الدفع بنجاح');
    return redirect('/invoices');
  }

  public function update_attachment(Request $request) {
    $request->validate([
      'invoice_attachment' => 'required|max:10000|mimes:pdf,doc,docx,xlsx,pptx',
    ], [
      'invoice_attachment.required' => 'يرجى ادخال المرفق',
      'invoice_attachment.mimes' => 'يرجى ادخال المرفق بصيغة صحيحة'
    ]);

    if($request->hasFile('invoice_attachment')) {
      $file = $request->file('invoice_attachment')->getClientOriginalName();
      $path = $request->file('invoice_attachment')->storeAs('invoices-attachments', $file, 'public_path');
    } else {
      $path = null;
    }

    $invoice_id = $request->id;
    $invoice = Invoice::findorFail($invoice_id);

    $invoice->update([
      'invoice_attachment' => $path,
    ]);

    session()->flash('edit', 'تم تعديل المرفق بنجاح');
    return redirect('/invoices');
  }
}