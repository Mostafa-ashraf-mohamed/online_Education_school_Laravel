<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subjectController extends Controller
{
    public function auth()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            return view('admin.subjectView');
        }
    }
    public function index()
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $departments = DB::table('departments')->get();

                foreach ($departments as $department) {
                    $department->subjects = DB::table('subjects')->where('D_id', $department->D_id)->get();
                }
                return redirect()->route('admin.subjectView')->with('departments', $departments);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function subjectindex($Subjectid)
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $teachersInSubject = DB::table('teachers')
                    ->where("S_id", $Subjectid)
                    ->get();

                return  view('admin.matrial', ['teachersInSubject' => $teachersInSubject]);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
    public function subjectTeacherindex($Subjectid, $teacherid)
    {
        if (session()->missing('type')) {
            return abort(401, 'Unauthorized');
        } else {
            if (session('type') == "admin") {
                $teachersInSubject = DB::table('teachers')
                    ->where("S_id", $Subjectid)
                    ->get();

                $units = DB::table('units')
                    ->leftJoin('videos', 'units.U_id', '=', 'videos.U_id')
                    ->leftJoin('materials', 'units.U_id', '=', 'materials.U_id')
                    ->where('units.T_id', $teacherid)
                    ->select('units.U_number', 'videos.V_id', 'videos.V_name', 'materials.M_path', 'materials.M_name')
                    ->get();


                return  view('admin.matrial', [
                    'teachersInSubject' => $teachersInSubject,
                    'units' => $units,
                ]);
            } else {
                return abort(401, 'Unauthorized');
            }
        }
    }
}
