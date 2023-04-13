<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function store(Request $request) {
        $request->validate([
            'section_name' => 'required|unique:sections',
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
        ]);

        Section::create([
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
            'created_by' => (Auth::user()->name),
        ]);

        session()->flash('add', 'تم اضافة القسم بنجاح');
        return redirect('/sections');
    }

    public function update(Request $request) {
        $section_id = $request->id;

        $request->validate([
            'section_name' => 'required',
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
        ]);
        
        $section = Section::find($section_id);
        $section->update([
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections');
    }

    public function destroy(Request $request) {
        $section_id = $request->id;
        Section::find($section_id)->delete();
        session()->flash('delete','تم حذف القسم بنجاج');
        return redirect('/sections');
    }
}