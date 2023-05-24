<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\material;
use Illuminate\Support\Facades\Storage;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class materialController extends Controller
{
    public function index()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "teacher") {
                $units = Unit::with('videos', 'materials')
                    ->where('T_id', session('teacherData')->getid())
                    ->get();
                return view('teacher.material', ['units' => $units,]);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function deleteUnit($id)
    {
        $units = Unit::with('videos', 'materials')
        ->where('U_id', $id)
        ->first();
        foreach ($units->materials as $data) {
            Storage::disk('public')->delete('upload/PDF/' . $data->M_path);
        }

        $unit = DB::table('units')->where('U_id', $id)->delete();
        if ($unit) {
            return redirect()->back()->with('mgs', 'operation done');
        } else {
            return redirect()->back()->with('mgs', 'operation error');
        }
    }
    public function deletevideo($id)
    {
        $test = DB::table('videos')->where('V_id', $id)->delete();
        if ($test) {
            return redirect()->back()->with('mgs', 'operation done');
        } else {
            return redirect()->back()->with('mgs', 'operation error');
        }
    }
    public function deleteMaterial($id)
    {
        $test = DB::table('materials')->where('M_id', $id)->first();
        Storage::disk('public')->delete('upload/PDF/' . $test->M_path);
        $test = DB::table('materials')->where('M_id', $id)->delete();
        if ($test) {
            return redirect()->back()->with('mgs', 'operation done');
        } else {
            return redirect()->back()->with('mgs', 'operation error');
        }
    }
    public function createChapter()
    {
        $rownum = count(DB::table('units')->where('T_id', session('teacherData')->getid())->get()) + 1;
        $insertUnit = DB::table('units')->insert([
            'U_number' => $rownum,
            'T_id' => session('teacherData')->getid(),
        ]);
        return redirect()->back();
    }
    public function addvideo(Request $request)
    {
        $link = $request->input('link');
        $title = $request->input('title');
        $Unit_id = $request->input('Unit_id');

        $validatedData = $request->validate([
            'link' => 'required',
            'title' => 'required',
            'Unit_id' => 'required',
        ]);

        $linkt = $validatedData['link'];
        $titlet = $validatedData['title'];
        $Unit_idt = $validatedData['Unit_id'];

        if ($linkt && $titlet && $Unit_idt) {
            DB::table('videos')->insert([
                'V_path' => $link,
                'V_name' => $title,
                'U_id' => $Unit_id,
            ]);

            return redirect()->back();
        }
    }
    public function addmaterial(Request $request)
    {
        $request->validate([
            'PDFfile' => 'required|file|mimes:pdf,ppt,pptx,doc,docx,rar,zip|max:2048',
            'PDFtitle' => 'required',
            'Unit_idPDF' => 'required',
        ]);

        $PDFfile = $request->file('PDFfile');
        $PDFtitle = $request->input('PDFtitle');
        $Unit_idPDF = $request->input('Unit_idPDF');

        // Generate a unique filename
        $filename = uniqid().'.'.$PDFfile->getClientOriginalExtension();

        // Store the file in the desired location
        $path = $PDFfile->storeAs('upload/PDF', $filename, 'public');

        if ($path) {
            // Save the file details in the database
            $material = new material();
            $material->M_path = $filename;
            $material->M_name = $PDFtitle;
            $material->U_id = $Unit_idPDF;
            $material->save();

            return redirect()->back();
        } else {
            // Handle the file upload error
            return back()->with('error', 'Failed to upload the file.');
        }
    }
}
