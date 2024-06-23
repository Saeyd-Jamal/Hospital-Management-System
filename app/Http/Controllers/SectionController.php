<?php

namespace App\Http\Controllers;

use App\Exports\SectionsExport;
use App\Imports\SectionsImport;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::paginate(10)->withQueryString();
        return view('dashboard.sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = new Section();
        return view('dashboard.sections.create',compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:255|unique:sections,name',
            'imageFile' => 'file|image'
        ]);
        if($request->hasFile('imageFile')){
            $imageFile = $request->file('imageFile');
            $imageName =  "section_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('sections',$imageName);
            $request->merge([
                'logo_image' => $imagePath,
            ]);
        }
        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', 'تم إضافة قسم جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('dashboard.sections.show',compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $btn_label = "تعديل القسم";
        $editItem = true;
        return view('dashboard.sections.edit',compact('section','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => "string|required|max:255|unique:sections,name,$section->name",
            'imageFile' => 'file|image'
        ]);
        $old_iamge = $section->logo_image;
        if($request->hasFile('imageFile')){
            if($old_iamge){
                Storage::delete($old_iamge);
            }
            $imageFile = $request->file('imageFile');
            $imageName =  "section_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('sections',$imageName);
            $request->merge([
                'logo_image' => $imagePath,
            ]);
        }
        $section->update($request->all());
        return redirect()->route('sections.index')->with('success', 'تم تحديث بيانات قسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $Section)
    {
        $old_iamge = $Section->logo_image;
        if($old_iamge){
            Storage::delete($old_iamge);
        }
        $Section->delete();
        return redirect()->route('sections.index')->with('danger', 'تم حذف القسم');
    }

}
