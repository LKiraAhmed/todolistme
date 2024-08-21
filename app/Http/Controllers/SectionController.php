<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
   
    public function index(Request $request)
    {
        $username = $request->user()->name;
        $sections = Section::where('creadt_by', $username)->select('id', 'section_name', 'description')->get();
        
      
        return view("sections.sec", compact("sections"));
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $sectionExists = section::where('section_name', $input['section_name'])->exists();
    
        if ($sectionExists) {
            session()->flash("Error", "Error: section already exists");
            return redirect()->back();
        } else {
            
        $validatedData = $request->validate([
             'section_name' => 'required|unique:sections|max:255',
              'description'=> 'required',
        ],[
                'section_name.name.required'=> 'Please_Add_Secion_Name ',
                'descriptiond.required'=> 'Please_Add_Secion_Name '
        ]);
            section::create([
                "section_name" => $request->section_name,
                "description" => $request->description,
                'creadt_by' => Auth::user()->name, 
            ]);
        }
    
        session()->flash('Add', 'Success: section added');
        return redirect("/section");
    }
    
    public function update(Request $request){
        $id=$request->id;
        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ]);
        $section = Section::find($id);
        $section->update([
            'section_name'=> $request->section_name,
            'description'=> $request->description
        ]);
        session()->flash('edit','Update Section Done');
        return redirect('/section');
    }

    public function delete(Request $request){
        $id= $request->id;
        $section = Section::find($id)->delete();
        session()->flash('delete','Delete Section Done');
        return redirect('/section');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $sections = Section::where('id', $search)->select('id', 'section_name', 'description')->get();
        }
    
        return view("sections.sec", compact("sections"));
    }

}
