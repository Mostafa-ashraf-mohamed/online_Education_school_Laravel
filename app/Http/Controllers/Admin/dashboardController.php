<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class dashboardController extends Controller
{
    public function charts()
    {
        if(session()->missing('type')){
            return abort(401, 'Unauthorized');
        }else{
            if(session('type')=="admin"){
                $studentsCount = DB::table('students')->get();
                $studentsCount = count($studentsCount);

                $departments = DB::table('departments')->get();

                $teachers = DB::table('teachers')->get();
                $subjects = DB::table('subjects')->get();

                $maleCount = DB::table('students')->where('St_gender','male')->get();
                $maleCount = count($maleCount);

                $femaleCount = DB::table('students')->where('St_gender','female')->get();
                $femaleCount = count($femaleCount);

                return view('admin.dashboard',[
                'studentsCount'=>$studentsCount,
                'departments'=>$departments,
                'teachers'=>$teachers,
                'subjects'=>$subjects,
                'maleCount'=>$maleCount,
                'femaleCount'=>$femaleCount,
                ]
            );
            }else{
                return abort(401, 'Unauthorized');
            }
        }
    }
}
