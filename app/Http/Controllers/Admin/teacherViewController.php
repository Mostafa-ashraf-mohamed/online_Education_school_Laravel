<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class teacherViewController extends Controller
{
    public function auth()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            return view('admin.teacherView');
        }
    }
    public function index()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $subjects = DB::table('subjects')->get();
                $departments = DB::table('departments')->get();
                $teachers = DB::table('teachers')
                    ->join('subjects', 'teachers.S_id', '=', 'subjects.S_id')
                    ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
                    ->get();
                $all_subjects = DB::table('departments')
                    ->join('subjects', 'departments.D_id', '=', 'subjects.D_id')
                    ->select('departments.*', 'subjects.*')
                    ->get();
                return redirect()->route('admin.teacherView')->with('subjects', $subjects)->with('departments', $departments)->with('teachers', $teachers)->with('all_subjects', $all_subjects);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function filter(Request $request)
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $gender = true;
                $search = true;
                $subject = true;
                $scientific = true;

                if ($request->has('gender')) {
                    $gender = "T_gender = '" . $request->input('gender') . "'";
                }
                if ($request->has('search')) {
                    $searchValue = $request->input('search');
                    if (!empty($searchValue)) {
                        $search = "(T_fname = '$searchValue' OR T_lname = '$searchValue')";
                    }
                }
                if ($request->has('subject')) {
                    $subject = "subjects.S_id = " . $request->input('subject');
                }
                if ($request->has('department')) {
                    $scientific = "departments.D_id = " . $request->input('department');
                }

                $teachers = DB::table('teachers')
                    ->join('subjects', 'teachers.S_id', '=', 'subjects.S_id')
                    ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
                    ->whereRaw("$gender AND $search AND $subject AND $scientific")
                    ->get();

                $subjects = DB::table('subjects')->get();
                $departments = DB::table('departments')->get();
                return redirect()->route('admin.teacherView')->with('teachers', $teachers)->with('subjects', $subjects)->with('departments', $departments);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function store(Request $request)
    {
        $data = [
            'T_email' => "noaddyet",
            'T_img' => '',
            'T_fname' => "" . $request->input('first_name'),
            'T_lname' => "" . $request->input('last_name'),
            'T_phNumber' => $request->input('phone_number'),
            'T_gender' => "" . $request->input('gender'),
            'S_id' => $request->input('subject_id'),
            'T_password' => '123456',
        ];
        $teachers = DB::table('teachers')
            ->join('subjects', 'teachers.S_id', '=', 'subjects.S_id')
            ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
            ->get();
        if (DB::table('teachers')->insert($data)) {
            $my_teacher = DB::table('teachers')->orderBy('T_id', 'desc')->first();
            $new_email = $my_teacher->T_fname . '.' . $my_teacher->T_lname . '.' . $my_teacher->T_id . '@teacher.school.edu';
            DB::table('teachers')->where('T_id', $my_teacher->T_id)->update(['T_email' => $new_email]);
            $teachers = DB::table('teachers')
                ->join('subjects', 'teachers.S_id', '=', 'subjects.S_id')
                ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
                ->get();
            return redirect()->route('admin.teacherView')->with('teachers', $teachers);
        } else {
            return redirect()->route('admin.teacherView')->with('teachers', $teachers)->with('errorad', true);
        }
    }
    public function show($id)
    {
        $profile_teacher = DB::table('teachers')
            ->join('subjects', 'teachers.S_id', '=', 'subjects.S_id')
            ->join('departments', 'subjects.D_id', '=', 'departments.D_id')
            ->select('teachers.*', 'subjects.*', 'departments.*')
            ->where('teachers.T_id', $id)
            ->first();
        return view('admin.teacherInfo', ['profile_teacher' => $profile_teacher]);
    }
    public function delete($id)
    {
        $delete = DB::table('teachers')
            ->where('T_id', $id)
            ->delete();
        if ($delete) {
            return redirect()->route('admin.teacherView')->with('msg', 'Record deleted successfully');
        } else {
            return redirect()->route('admin.teacherView')->with('error', true);
        }
    }
}
