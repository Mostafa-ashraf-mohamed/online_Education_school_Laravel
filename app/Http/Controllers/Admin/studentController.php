<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class studentController extends Controller
{
    public function auth()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            return view('admin.studentView');
        }
    }
    public function index()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin" || session('type') == "teacher") {
                $students = DB::table('students')
                    ->join('departments', 'students.D_id', '=', 'departments.D_id')
                    ->select('*')
                    ->get();

                return redirect()->route('admin.studentView')->with('students', $students);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function show($id)
    {

        $profile_student2 = DB::table('students')
            ->join('departments', 'students.D_id', '=', 'departments.D_id')
            ->where('students.St_id', $id)
            ->select('students.*', 'departments.D_name')
            ->first();

        $comments = DB::table('comments')
            ->join('students', 'comments.St_id', '=', 'students.St_id')
            ->where('comments.St_id', $id)
            ->get();

        if ($profile_student2) {
            return view('admin.studentinfo', ['profile_student2' => $profile_student2,'comments'=>$comments]);
        } else {
            return view('admin.studentinfo', ['error' => true]);
        }
    }
    public function delete($id)
    {
        $delete = DB::table('students')
            ->where('St_id', $id)
            ->delete();
        if ($delete) {
            return redirect()->route('admin.studentView.index')->with('mgs', 'Record update successfully');
        } else {
            return redirect()->route('admin.studentView.index')->with('error', true);
        }
    }
}
