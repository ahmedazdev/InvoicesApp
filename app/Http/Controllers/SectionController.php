<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('section.section', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ]);


        $input = $request->all();

        //التأكد من التسجيل مسبقا للقسم او لا

        $b_exist =Section::where('section_name','=', $input['section_name'])->first();

        if($b_exist){
            session()->flash('error', 'القسم موجود مسبقاًً');
            return redirect('/section');
        }
        else{
            Section::create([
                'section_name' => $input['section_name'],
                'description' => $input['description'],
                'created_by' => auth()->user()->name
            ]);
            session()->flash('Add','تم إضافة القسم بنجاح');
            return redirect('/section');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

           'section_name.required'=>'يرجى ادخال إشسم القسم',
           'description.required'=>'يرجى ادخال التفاصيل',
           'section_name.unique'=>'إسم القسم مسجل مسبقا'
        ]);

        $sections =Section::find($id);
        $sections->update([
            'section_name' => $request['section_name'],
            'description' => $request['description'],
        ]);

        session()->flash('edit','تم تعديل القسم بنجاح');
        return redirect('/section');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        Section::find($id)->delete();
        session()->flash('delete','تم الحزف بنجاح');
        return redirect('/section');

    }


}
