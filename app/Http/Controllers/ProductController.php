<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $products = Product::all();
        $sections = Section::all();
        return view('products.index', compact('products', 'sections'));
    }

    public function store(Request $request) {
        $request->validate([
            'product_name' => 'required'
        ], [
            'product_name.required' => 'يرجي ادخال اسم المنتج',
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'section_id' => $request->section_id,
        ]);

        session()->flash('add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    public function update(Request $request) {
        $section_id = Section::where('section_name', $request->section_name)->first()->id;
        
        $product_id = $request->id;
        $product = Product::find($product_id);
 
        $request->validate([
            'product_name' => 'required'
        ], [
            'product_name.required' => 'يرجي ادخال اسم المنتج',
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'section_id' => $section_id,
        ]);
 
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('/products');
    }

    public function destroy(Request $request) {
        $product_id = $request->id;
        Product::find($product_id)->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}