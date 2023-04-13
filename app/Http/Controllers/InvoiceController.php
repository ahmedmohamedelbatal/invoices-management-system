<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
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
            'invoice_number' => 'required',
            'Date' => 'required',
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
        ], [
            'required' => 'حقل الادخال هذا مطلوب',
            'mimes' => 'يرجى ادخال الملف بصيغة صحيحة',
        ]);

        $file = $request->file('invoice_attachment')->getClientOriginalName();
        $path = $request->file('invoice_attachment')->storeAs('invoices-attachments', $file, 'public_path');
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
            'invoice_status' => 'غير مدفوعة',
            'invoice_value_status' => 2,
            'invoice_note' => $request->note,
            'invoice_attachment' => $path,
        ]);

        session()->flash('add', 'تم اضافة الفاتورة بنجاح');
        return redirect('/invoices');
    }

    public function edit(int $id) {
        //
    }
    public function update(Request $request, int $id) {
        //
    }

    public function destroy(Request $request) {
        $invoice_id = $request->id;
        Invoice::find($invoice_id)->delete();
        session()->flash('delete','تم حذف القسم بنجاج');
        return redirect('/invoices');
    }

    public function GetProducts(int $id) {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
}