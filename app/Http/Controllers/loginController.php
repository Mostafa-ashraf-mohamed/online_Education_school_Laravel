<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\classes\Teacher;
use App\classes\Student;

class loginController extends Controller
{
    public function firstRun($lange = null)
    {
        if (isset($lange)) {
            app()->setLocale($lange);
        }
        $departments = DB::table('departments')->get();
        return view('login', ['departments' => $departments]);
    }
    public function index(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $departments = DB::table('departments')->get();




        if (strpos($email, '@teacher.school.edu') !== false) {
            $teacher = DB::table('teachers')->where('T_email', $email)->where('T_password', $password)->first();
            if ($teacher) {
                $teacherData = new Teacher(
                    $teacher->T_id,
                    $teacher->T_fname,
                    $teacher->T_lname,
                    $teacher->T_gender,
                    $teacher->T_email,
                    $teacher->T_img,
                    $teacher->S_id,
                    $teacher->T_phNumber,
                    $teacher->T_password,
                );
                session()->put('type', "teacher");
                session()->put('teacherData', $teacherData);
                return  redirect()->route('teacher.material');
            } else {
                return view('login', [
                    'loginState' => false,
                    'error' => 'wrong email or password teacher',
                    'departments' => $departments,
                ]);
            }
        } elseif ($email === "admin.0@admin.school.edu") {
            if ($password === "1234") {
                session(['type' => "admin"]);
                session(['locale' => "en"]);
                return redirect()->route('admin.dashboard');
            } else {
                return view('login', [
                    'error' => 'wrong email or password admin',
                    'departments' => $departments,
                ]);
            }
        } else {
            $student = DB::table('students')->where('St_email', $email)->where('St_password', $password)->first();
            if ($student) {
                $isblocked = DB::table('blocks')->where('St_id', $student->St_id)->first();
                if ($isblocked) {
                    return view('login', [
                        'error' => 'you are blocked to use our services because this comment (' . $isblocked->comment . ')',
                        'departments' => $departments,
                    ]);
                } else {
                    $studentData = new Student(
                        $student->St_id,
                        $student->St_fname,
                        $student->St_lname,
                        $student->St_gender,
                        $student->St_email,
                        $student->St_DOB,
                        $student->St_img,
                        $student->D_id,
                        $student->St_phNumber,
                        $student->St_password,
                    );
                    // Start a new session
                    $queryParameters = http_build_query([
                        'St_id' => "$student->St_id",
                        'St_fname'=>"$student->St_fname",
                        'St_lname'=>"$student->St_lname",
                        'St_gender'=>"$student->St_gender",
                        'St_email'=>"$student->St_email",
                        'St_DOB'=>"$student->St_DOB",
                        'St_img'=>"$student->St_img",
                        'D_id'=>"$student->D_id",
                        'St_phNumber'=>"$student->St_phNumber",
                        'St_password'=>"$student->St_password",
                        'type' => 'student',
                        'lang' => ''.app()->getLocale(),
                    ]);

                    return back();
                    // $redirectUrl = '' . $queryParameters;

                    // return redirect()->away($redirectUrl); //not complete
                }
            } else {
                return view('login', [
                    'error' => 'wrong email or password students',
                    'departments' => $departments,
                ]);
            }
        }
    }
    public function create(Request $request)
    {
        $departments = DB::table('departments')->get();


        $F_name = $request->input('F_name');
        $L_name = $request->input('L_name');
        $phone_number = $request->input('phonenumber');
        $c_email = $request->input('c_email');
        $c_password = $request->input('c_password');
        $DOB = $request->input('DOB');
        $gender = $request->input('gender');
        $department = $request->input('department');

        $error = array(
            'nameerr' => false,
            'phone_numbererr' => false,
            'c_emailerr' => false,
            'departmenteerr' => false,
            'c_passworderr' => false,
            'DOBerr' => false,
            'gendereerr' => false,
        );

        try {
            $validatedData = $request->validate([
                'F_name' => 'required',
                'L_name' => 'required',
                'phonenumber' => 'required|numeric',
                'c_email' => 'required|email',
                'c_password' => 'required|min:8',
                'DOB' => 'required',
                'gender' => 'required',
                'department' => 'required|numeric',
            ]);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();

            if (array_key_exists('F_name', $errors)) {
                $error['nameerr'] = true;
            }

            if (array_key_exists('L_name', $errors)) {
                $error['nameerr'] = true;
            }

            if (array_key_exists('phone_number', $errors)) {
                $error['phone_numbererr'] = true;
            }

            if (array_key_exists('c_email', $errors)) {
                $error['c_emailerr'] = true;
            }

            if (array_key_exists('department', $errors)) {
                $error['departmenteerr'] = true;
            }

            if (array_key_exists('c_password', $errors)) {
                $error['c_passworderr'] = true;
            }

            if (array_key_exists('DOB', $errors)) {
                $error['DOBerr'] = true;
            }

            if (array_key_exists('gender', $errors)) {
                $error['gendereerr'] = true;
            }
        }
        $hasError = false;

        foreach ($error as $value) {
            if ($value) {
                $hasError = true;
                break;
            }
        }
        if (!$hasError) {
            $isused = DB::table('students')->where('St_email', $c_email)->exists();
            if ($isused) {
                return view(
                    'login',
                    [
                        'createStates' => false,
                        'massage' => "this email is already in use",
                        'departments' => $departments,
                    ]
                );
            }
            $isInserted = DB::table('students')->insert([
                'St_id' => NULL,
                'St_phNumber' => $phone_number,
                'St_fname' => "$F_name",
                'St_lname' => "$L_name",
                'St_gender' => "$gender",
                'St_DOB' => "$DOB",
                'St_img' => "",
                'St_password' => $c_password, //Hash::make($c_password),
                'D_id' => $department,
                'St_email' => "$c_email",
            ]);

            if ($isInserted) {
                return view(
                    'login',
                    [
                        'createStates' => true,
                        'massage' => "Email was create, know you can use our servies enjoy ",
                        'departments' => $departments,
                    ]
                );
            } else {
                return view(
                    'login',
                    [
                        'createStates' => false,
                        'massage' => "something went wrong please contact us for help",
                        'departments' => $departments,
                    ]
                );
            }
        } else {
            return view(
                'login',
                [
                    'createStates' => false,
                    'createerror' => $error,
                    'departments' => $departments,
                ]
            );
        }
    }
}
