<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class settingController extends Controller
{
    public function index()
    {
        $departments = DB::table('departments')->get();
        $subjects = DB::table('subjects')
            ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
            ->select('subjects.*', 'departments.*')
            ->get();
        $blocks = DB::table('blocks')
            ->join('students', 'blocks.St_id', '=', 'students.St_id')
            ->select('blocks.*', 'students.*')
            ->get();
        return view('admin.setting', [
            "departments" => $departments,
            "subjects" => $subjects,
            "blocks" => $blocks,
        ]);
    }

    public function deleteSubject($id)
    {

        $test = DB::table('subjects')->where('S_id', $id)->delete();

        if($test){
            return redirect()->back()->with('mgs','operation done');
        }else{
            return redirect()->back()->with('mgs','operation error');
        }
    }

    public function deleteDepartment($id)
    {
        $test = DB::table('departments')->where('D_id', $id)->delete();

        if($test){
            return redirect()->back()->with('mgs','operation done');
        }else{
            return redirect()->back()->with('mgs','operation error');
        }
    }

    public function storeDepartment(Request $request)
    {
        $d_name = $request->input('department');


        $test = DB::table('departments')->insert([
            'D_name' => $d_name,
        ]);

        if($test){
            return redirect()->back()->with('mgs','operation done');
        }else{
            return redirect()->back()->with('mgs','operation error');
        }
    }

    public function storeSubject(Request $request)
    {
        $d_id = $request->input('Did');
        $s_name = $request->input('subject');

        $test = DB::table('subjects')->insert([
            'D_id' => $d_id,
            'S_name' => $s_name,
        ]);
        if($test){
            return redirect()->back()->with('mgs','operation done');
        }else{
            return redirect()->back()->with('mgs','operation error');
        }
    }
    public function blockremove($id){
        $test = DB::table('blocks')->where('St_id', $id)->delete();
        if($test){
            return redirect()->back()->with('mgs','operation done');
        }else{
            return redirect()->back()->with('mgs','operation error');
        }

    }
}
