<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class welcomeController extends Controller
{
    public function firstRun()
    {
        $studentsCount = DB::table('students')->get();
        $studentsCount = count($studentsCount);

        $subjectsCount = DB::table('subjects')->get();
        $subjectsCount = count($subjectsCount);

        $TeachersCount = DB::table('teachers')->get();
        $TeachersCount = count($TeachersCount);

        $departments = DB::table('departments')->get();

        return view('welcome', [
            'studentsCount' => $studentsCount,
            'subjectsCount' => $subjectsCount,
            'TeachersCount' => $TeachersCount,
            'departments' => $departments,
        ]);
    }
}
